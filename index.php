<head>
    <title>LegacySearch</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<?php
    $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
    if( $iPod || $iPhone || $Android){
        echo "<style> #wallpaper{width: 100%;}</style>";
    }else{
        echo "<style> #wallpaper{width: 50%;}</style>";
    };
?>
<style>
    a:link {
      color: white;
    }

    /* visited link */
    a:visited {
      color: wheat;
    }

    ::selection {
    background: 
        transparent;
    }
    .top_bar {
        width: 100%;
        position: absolute;
        top: 0;
        height: 96px;
        text-align: center;
        background: -webkit-gradient(linear, left top, left bottom, from(#222222), to(#000), color-stop(0.5, rgba(21, 21, 21, 0.7)), color-stop(0.5, rgba(0, 0, 0, 0.7)));
        border-bottom: 1px solid #343434;
    }
    .top_bar h1 {
        margin-top: 5px;
        font-size: 52px;
        font-weight: lighter;
        color: #f0f0f0;
        text-shadow: #000 0px -2px 0px;
    }
    h1 {
        display: block;
        font-size: 2em;
        margin-block-start: 0.67em;
        margin-block-end: 0.67em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }
    .top_bar h2 {
        opacity: 1;
        margin-top: -2.2em;
        font-weight: normal;
        color: #fff;
        font-size: 16px;
        text-shadow: #000 0px -2px 0px;}
    h2 {
        display: block;
        font-size: 1.5em;
        margin-block-start: 0.83em;
        margin-block-end: 0.83em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }
    @keyframes slide {
        from { transform : translateX(0em) }
        to   { transform : translateX(16.5em) }
    }
    #unlock_text {
        position: absolute;
        text-align: center;
        left: 90px;
        top: 12px;
        color: #ffffff;
        font-size: 22px;
        font-family: Helvetica;
        -webkit-mask-image: -webkit-gradient(linear, left bottom, right bottom, from(rgba(0,0,0,0.5)), to(rgba(0,0,0,0.5)));
        mask-image: -webkit-gradient(linear, left bottom, right bottom, from(rgba(0,0,0,0.5)), to(rgba(0,0,0,0.5)));
    }
    #search_term {
        color: #ffffff;
        font-size: 22px;
        font-family: Helvetica;
        background: transparent;
        border: none;
    }
    .tool_bar {
        position: absolute;
        top: 325px;
        height: 96px;
        width: 100%;
        background: -webkit-gradient(linear, left top, left bottom, from(rgba(34, 34, 34, 0.7)), to(rgba(0, 0, 0, 0.7)), color-stop(0.5, rgba(21, 21, 21, 0.7)), color-stop(0.5, rgba(0, 0, 0, 0.7)));
        border-top: 1px solid #343434;
    }
    #unlock1, #unlock2 {
        -webkit-border-radius: 13px;
        border-radius: 13px;
    }
    #unlock1 {
        border: 1px solid rgba(30, 30, 30, 0.88);
        margin-top: 22px;
        width: 282px;
        margin-left: auto;
        margin-right: auto;
    }
    #unlock2 {
        width: 282px;
        height: 50px;
        border: 1px solid rgba(100, 100, 100, 0.88);
        background-color:#000000C4;
        position: relative;
    }
    #slider {
        width: 59px;
        height: 44px;
        /*animation-duration: 3s;*/
        border-radius: 10px;
        -webkit-border-radius: 10px;
        -webkit-border-top-left-radius: 10px;
        border-top-left-radius: 10px;
        -webkit-border-top-right-radius: 10px;
        border-top-right-radius: 10px;
        -webkit-border-bottom-left-radius: 10px;
        border-bottom-left-radius: 10px;
        -webkit-border-bottom-right-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-top: 2px;
        margin-left: 2px;
        border: 1px solid #ccc;
        -webkit-box-shadow: 0px 2px 4px rgb(0 0 0 / 40%);
        box-shadow: 0px 2px 4px rgb(0 0 0 / 40%);
        background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#919191));
        position: relative;
    }
    body {
        margin: 0;
        padding: 0;
        background-repeat: no-repeat;
        font-family: "Helvetica", sans-serif;
        background-color: #000;
    }
    .arrow {
        position: absolute;
        left: 16px;
        top: 12px;
    }
    #result_div{
        position: relative;
        width:555px; 
    }
    #wallpaper{
        margin: auto;
        height: 325px;
        background: url('iossex.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-size: 100%;
        background-position: center;
    }
    #nein{
        background-color: #000;
        background-image: none;
    }
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    function sleep (time) {
        return new Promise((resolve) => setTimeout(resolve, time));
    }
    $.ajax({
        url:"https://api.nasa.gov/planetary/apod?api_key=McJy20HVDlixvs1aVs2LimwmamOJ94bJYtyVbiwc",
        success: function (whatyougot) {
            document.getElementById("wallpaper").style.background="url("+whatyougot.url+")"
        }
    })
    function do_search()
    {
        var search_term=$("#search_term").val();
        $.ajax
        ({
            type:'post',
            url:'get_results.php',
            data:{
                search:"search",
                search_term:search_term
            },
            success:function(response) {
                document.getElementById("result_div").innerHTML=response;
            }
        });
        return false;
        console.log(false)
    }
</script>
<body>
    <div class="top_bar">
        <h1>LegacySearch</h1><h2 id="by">Search for tweaks, iOS firmware and iOS apps accross our wide database!</h2>
    </div>
    <div id="wallpaper">
    </div>
    <div class="tool_bar">
        <div id="unlock1"> 
            <div id="unlock2"> 
                <button id="slider" class="slider" onclick="
                    document.getElementById('slider').style.animationName='slide'
                    document.getElementById('slider').style.animationDuration='1s'
                    document.getElementById('unlock_text')
                        .style.display='none'
                    sleep(1000).then(()=>{
                    var audio = new Audio('unlock.mp3');
                    audio.play();
                    document.getElementById('unlock_text')
                        .style.display='block'
                    document.getElementById('slider').style.animationName=''
                    do_search()
                    })
                ">
                    <img class="arrow" src="data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20standalone%3D%22no%22%3F%3E%3C%21DOCTYPE%20svg%20PUBLIC%20%22-//W3C//DTD%20SVG%201.1//EN%22%20%22http%3A//www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd%22%3E%3Csvg%20width%3D%2231px%22%20height%3D%2224px%22%20version%3D%221.1%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Cdefs%3E%3ClinearGradient%20id%3D%22x%22%20x1%3D%220%25%22%20y1%3D%220%25%22%20x2%3D%220%25%22%20y2%3D%22100%25%22%3E%3Cstop%20offset%3D%220%25%22%20style%3D%22stop-color%3A%239c9c9c%22/%3E%3Cstop%20offset%3D%2250%25%22%20style%3D%22stop-color%3A%23575757%22/%3E%3Cstop%20offset%3D%2250%25%22%20style%3D%22stop-color%3A%23000000%22/%3E%3Cstop%20offset%3D%22100%25%22%20style%3D%22stop-color%3A%23000000%22/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpolygon%20points%3D%221%2C8%2017%2C8%2017%2C2%2029%2C12.5%2017%2C23%2017%2C16%201%2C16%22%20style%3D%22stroke%3A%23d8d8d8%3Bstroke-width%3A1%3B%22/%3E%3Cpolygon%20points%3D%221%2C7%2017%2C7%2017%2C1%2029%2C11.5%2017%2C22%2017%2C15%201%2C15%22%20style%3D%22fill%3Aurl%28%23x%29%3B%20stroke%3A%23000000%3Bstroke-width%3A1%3B%22/%3E%3C/svg%3E">
                </button>
                <!--form method="post" action="search.php" onsubmit="do_search();"-->
                    <div id="unlock_text"><input type="text" id="search_term" name="search_term" placeholder="slide to search" onkeyup=""></div>
                <!--/form-->            
            </div>
        </div>
    </div>
    <div id="nein">
        <center>
            <div id="result_div"></div>
        </center>  
    </div>
</body>