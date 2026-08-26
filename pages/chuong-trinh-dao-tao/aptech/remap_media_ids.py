#!/usr/bin/env python3
"""Rewrite media IDs in shortcode_draft.txt after re-uploading images to a
new WordPress site (production, a fresh local DB, etc).

Why this exists: shortcode_draft.txt hardcodes numeric WP attachment IDs
(id="...", img="...", bg="...") from whichever site the images were last
uploaded to. Re-uploading elsewhere always produces different IDs, so every
one of those references goes stale ("bị lệch image id") until remapped.

Matching is done by FILENAME (the one stable key across environments), not
by position or old ID — so it's correct even if the two CSVs list files in
a different order.

Usage:
    python3 remap_media_ids.py OLD.csv NEW.csv shortcode_draft.txt

Both CSVs must be "filename,id" with a header row (see
media-id-map-local.csv for the exact format, and
import-media-and-map.sh to generate NEW.csv on the target site).

Writes the result back to shortcode_draft.txt in place, after saving a
"<file>.bak" backup. Prints any filename present in OLD.csv but missing
from NEW.csv (those IDs are left untouched and need a manual look).
"""
import csv
import re
import sys


def load_map(path):
    mapping = {}
    with open(path, encoding="utf-8") as f:
        reader = csv.reader(f)
        next(reader, None)  # header
        for row in reader:
            if len(row) < 2 or not row[1].strip():
                continue
            mapping[row[0].strip()] = row[1].strip()
    return mapping


def main():
    if len(sys.argv) != 4:
        print(__doc__)
        sys.exit(1)

    old_csv, new_csv, shortcode_path = sys.argv[1:4]
    old_map = load_map(old_csv)  # filename -> old_id
    new_map = load_map(new_csv)  # filename -> new_id

    old_id_to_new_id = {}
    missing = []
    for filename, old_id in old_map.items():
        new_id = new_map.get(filename)
        if new_id is None:
            missing.append(filename)
            continue
        old_id_to_new_id[old_id] = new_id

    with open(shortcode_path, encoding="utf-8") as f:
        content = f.read()

    with open(shortcode_path + ".bak", "w", encoding="utf-8") as f:
        f.write(content)

    pattern = re.compile(r'\b(id|img|bg)="(\d+)"')

    replaced = 0
    untouched_ids = set()

    def repl(m):
        nonlocal replaced
        attr, old_id = m.group(1), m.group(2)
        new_id = old_id_to_new_id.get(old_id)
        if new_id is None:
            untouched_ids.add(old_id)
            return m.group(0)
        replaced += 1
        return f'{attr}="{new_id}"'

    new_content = pattern.sub(repl, content)

    with open(shortcode_path, "w", encoding="utf-8") as f:
        f.write(new_content)

    print(f"Replaced {replaced} id/img/bg attribute(s).")
    if untouched_ids:
        print(
            "Left untouched (not media IDs, e.g. contact-form-7 id): "
            + ", ".join(sorted(untouched_ids))
        )
    if missing:
        print("Filenames in OLD csv but missing from NEW csv (not remapped):")
        for fn in missing:
            print(f"  - {fn}")
    print(f"Backup saved to {shortcode_path}.bak")


if __name__ == "__main__":
    main()
