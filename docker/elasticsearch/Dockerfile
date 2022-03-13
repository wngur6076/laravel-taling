FROM elasticsearch:7.16.3
RUN bin/elasticsearch-plugin install --batch analysis-nori ## 한글 형태소 분석기
RUN bin/elasticsearch-plugin install --batch https://github.com/jhs512/lib_2022/raw/master/docs/javacafe-analyzer-7.16.3.zip
