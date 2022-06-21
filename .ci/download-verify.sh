#!/usr/bin/env bash
set -xeo pipefail

TAG_NAME="${1}"
TARGET=${2}
GITHUB=github

echo 'download artifacts'
mkdir $GITHUB || true
cd $GITHUB
## TODO: Sergey Kleyman: Remove --repo "SergeyKleyman/apm-agent-php"
gh release download "$TAG_NAME" --repo "SergeyKleyman/apm-agent-php"
cd ..

echo 'debug github artifacts'
ls -l $GITHUB

echo 'debug target artifacts'
ls -l $TARGET

echo 'calculate the sha512'
sort $GITHUB/*.sha512 > github.sha512
sort $TARGET/*.sha512 > target.sha512

echo 'verify sha512 are valid'
diff github.sha512 target.sha512 || exit 1

echo 'debug: sha512 for the github artifacts'
cat github.sha512

echo 'debug: sha512 for the signed artifacts'
cat target.sha512
