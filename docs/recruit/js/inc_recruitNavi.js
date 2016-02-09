$(function(){
  var html = '\
    <div class="recruitnavi-container">\
      <ul>\
        <li>\
          <ul>\
            <li><a href="/recruit/career.html">中途採用</a></li>\
            <li><a href="/recruit/job_ae.html">事業職（法人営業）</a></li>\
            <li><a href="/recruit/job_en.html">WEBサービスエンジニア</a></li>\
            <li><a href="/recruit/job_en_app.html">アプリケーションエンジニア</a></li>\
            <li><a href="/recruit/job_de.html">デザイナー</a></li>\
          </ul>\
        </li>\
        <li>\
          <ul>\
            <li><a href="/recruit/newgrads.html">新卒採用</a></li>\
            <li><a href="/recruit/entry_2017.html">2017年度新卒採用</a></li>\
          </ul>\
        </li>\
        <li>\
          <ul  >\
            <li><a href="/recruit/history.html">Fringe81の歴史</a></li>\
            <li><a href="/recruit/member.html">社員紹介</a></li>\
            <li><a href="/culture/">企業文化</a></li>\
          </ul>\
        </li>\
      </ul>\
    </div>\
  ';
  
  $('div#recruitNavi').html(html);
});

$(function(){
  var url = window.location.pathname;
  $('a[href="'+url+'"]').addClass('act');
});