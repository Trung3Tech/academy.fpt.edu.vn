#!/bin/bash
# Upload every image in aptech_assets/ to the WP Media Library of whatever site
# `wp` is currently pointed at, capturing filename -> new media ID as it goes.
#
# Usage (run from anywhere; cd into the target WP root first so `wp` resolves
# the right site, e.g. `cd /path/to/wordpress` before calling this script):
#   bash import_media_and_map.sh <assets_dir> <output_csv> [--allow-root]
#
# Example (local dev):
#   cd /Volumes/DEVDATA/FAI/Academy/LocalSite
#   bash ../AcademyFPT/pages/chuong-trinh-dao-tao/aptech/import_media_and_map.sh \
#     ../AcademyFPT/pages/chuong-trinh-dao-tao/aptech/aptech_assets \
#     ../AcademyFPT/pages/chuong-trinh-dao-tao/aptech/media-id-map-production.csv --allow-root
#
# Re-running is safe: WordPress auto-suffixes filenames it already has
# (e.g. foo-2.jpg), so no existing media gets overwritten — but that also
# means re-running against a site that already has these files will produce
# a NEW set of IDs each time. Only run it once per target site.

set -euo pipefail

ASSETS_DIR="${1:?Usage: import_media_and_map.sh <assets_dir> <output_csv> [--allow-root]}"
OUT_CSV="${2:?Usage: import_media_and_map.sh <assets_dir> <output_csv> [--allow-root]}"
WP_FLAG="${3:-}"

echo "filename,media_id" > "$OUT_CSV"
count=0
for f in "$ASSETS_DIR"/*; do
  fname=$(basename "$f")
  id=$(wp media import "$f" --porcelain $WP_FLAG 2>/dev/null | tail -1)
  echo "$fname,$id" >> "$OUT_CSV"
  count=$((count + 1))
done

echo "Imported $count files -> $OUT_CSV"
