#!/bin/bash

# git_pull_and_rerun.sh 파일내용

# 테스트 환경에서 테스트 먼저
{
  docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5_test/ ; git pull origin master"
  docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5_test/ ; composer install"
  docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5_test/ ; php artisan test"
} || {
  exit 1
}

# 폴더에 깃에 있는 최신소스코드 가져오기
docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5/ ; git pull origin master"

# 의존성 설치
docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5/ ; composer install"

# 마이그레이트
docker exec php__1 bash -ce "cd /data/site_projects/php__1/site_projects/site5/ ; php artisan migrate"

exit 0
