<style>
    body {
        margin: 0;
        padding: 0;
        background: #000;
        background-repeat: no-repeat;
        font-family: "Helvetica", sans-serif;
    }
    .middle_wrapper {
        position: absolute;
        top: 96px;
        width: 100%;
    }
    .bubble {
        margin-top: 27px;
        /* background-color: rgba(0, 20, 70, 0.796875); */
        background-color: rgba(55, 55, 55, 0.815624);
        border: 3px solid rgba(190, 196, 208, 0.937500);
        border-radius: 11px;
        border-top-left-radius: 11px;
        border-top-right-radius: 11px;
        border-bottom-left-radius: 11px;
        border-bottom-right-radius: 11px;
        box-shadow: 0px 4px 4px rgb(0 0 0 / 40%);
        border-top-left-radius: 11px;
        border-top-right-radius: 11px;
        border-bottom-left-radius: 11px;
        border-bottom-right-radius: 11px;
        box-shadow: 0px 4px 4px rgb(0 0 0 / 40%);
        text-shadow: #000 0px -1px 0px;
        width: 262px;
        height: 170px;
        font-size: 16px;
        text-align: center;
        color: white;
        position: relative;
        padding: 0 5px;
    }
    .shadow {
        -webkit-border-radius: 0px;
        -webkit-border-bottom-right-radius: 10px;
        -webkit-border-bottom-left-radius: 10px;
        -moz-border-radius-bottomright: 10px;
        -moz-border-radius-bottomleft: 10px;
        border-radius: 0px;
        border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
        background-color: rgba(255, 255, 255, 0.4);
        position: absolute;
        left: 50%;
        margin-left: -10px;
        width: 20px;
        height: 25px;
        -webkit-transform: scaleX(13.6) /* 272/20 */;
        transform: scaleX(13.6) /* 272/20 */;
    }
    .ttitle {
        font-weight: bold;
        margin-top: 7px;
        margin-bottom: 5px;
    }
    .ttop {
        padding-top: 5px;
    }
    .ttext {
        margin-top: 5px;
    }
    .tbottom {
        font-weight: bold;
        position: absolute;
        bottom: 14px;
    }
</style>
<?php
    if(isset($_POST['search']))
    {
        include_once('fix_mysql.inc.php');
        $host="localhost";
        $username="root";
        $password="69420sexballs";
        $databasename="search";
        $connect=mysql_connect($host,$username,$password);
        $db=mysql_select_db($databasename);
        $search_val=$_POST['search_term'];
        $get_result = mysql_query("SELECT * FROM search WHERE levenshtein('$search_val',`title`) BETWEEN 0 AND 4");
        if (!$get_result) {
            die('Invalid query: ' . mysql_error());
        }
        while($row=mysql_fetch_array($get_result))
        {
            echo"
            <head>
                <meta name='apple-mobile-web-app-capable' content='yes'>
                <meta content='text/html; charset=utf-8' http-equiv='content-type'>
                <meta name='viewport' content='width=device-width, initial-scale=1' />
            </head>
            <div class='middle_wrapper'>
                <div class='bubble middle'>
                    <div class='shadow'></div>
                    <div id='texts'>
                        <div class='ttitle ttop'><a href='".$row['link']."'>".$row['title']."</a></div>
                        <div class='ttext'>
                        ".$row['description']."
                        </div>
                    </div>
                </div>
            </div>";
            //echo "<head><meta name='apple-mobile-web-app-capable' content='yes'><meta content='text/html; charset=utf-8' http-equiv='content-type'><meta name='viewport' content='width=device-width, initial-scale=1' /></head><a style='color:#ffffff;' href='".$row['link']."' class='title'>".$row['title']."</a><br><span class='desc' style='color: #ffffff;'>".$row['description']."</span></a></li><br><br>";
        }
        $anymatches=mysql_num_rows($get_result); 
        if ($anymatches == 0)  
        { 
            echo"
            <head>
                <meta name='apple-mobile-web-app-capable' content='yes'>
                <meta content='text/html; charset=utf-8' http-equiv='content-type'>
                <meta name='viewport' content='width=device-width, initial-scale=1' />
            </head>
            <div class='middle_wrapper'>
                <div class='bubble middle'>
                    <div class='shadow'></div>
                    <div id='texts'>
                        <div class='ttitle ttop'>Nothing was found regarding your search.</div>
                        <div class='ttext'>
                        Check for spelling mistakes or incorect version numbers.
                        </div>
                        <div class='ttitle ttop'><a href='/list'>check all the IPAs here</a></div>
                    </div>
                </div>
            </div>";
            //echo "<p style='color: #ffffff;'>Nothing was found that matched your query.</p><br><br>"; 
        }
    }
?>