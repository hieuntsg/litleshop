<?php 

$today            =    'Hôm nay'; 
    $yesterday        =    'Hôm qua'; 
    $x_month        =    'Tháng này'; 
    $x_week            =    'Tuần này'; 
    $all            =    'Tất cả'; 
     
    $locktime        =  15; 
    $initialvalue    =    1; 
    $records        =    100000; 
     
    $s_today        =    1; 
    $s_yesterday    =    1; 
    $s_all            =    1; 
    $s_week            =    1; 
    $s_month        =    1; 
     
    $s_digit        =    1; 
    $disp_type        =     'Mechanical'; 
     
    $widthtable        =    '60'; 
    $pretext        =     ''; 
    $posttext        =     ''; 
    $locktime        =    $locktime * 60; 
    // Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable. 
    $day             =    date('d'); 
    $month             =    date('n'); 
    $year             =    date('Y'); 
    $daystart         =    mktime(0,0,0,$month,$day,$year); 
    $monthstart         =  mktime(0,0,0,$month,1,$year); 
    // weekstart 
    $weekday         =    date('w'); 
    $weekday--; 
    if ($weekday < 0)    $weekday = 7; 
    $weekday         =    $weekday * 24*60*60; 
    $weekstart         =    $daystart - $weekday; 

    $yesterdaystart     =    $daystart - (24*60*60); 
    $now             =    time(); 
    $ip                 =    $_SERVER['REMOTE_ADDR']; 
     
    $query             =    "SELECT MAX(id) AS total FROM table_counter"; 
    $t = mysql_fetch_assoc(mysql_query($query)); 
    $all_visitors     =    $t['total'] + 56700; 
     
    if ($all_visitors !== NULL) { 
        $all_visitors += $initialvalue; 
    } else { 
        $all_visitors = $initialvalue; 
    } 
     
    // Delete old records 
    $temp = $all_visitors - $records; 
     
    if ($temp>0){ 
        $query         =  "DELETE FROM #_counter WHERE id<'$temp'"; 
        mysql_query($query); 
    } 
     
    $query             =    "SELECT COUNT(*) AS visitip FROM #_counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'"; 
    $vip  = mysql_fetch_assoc($d->query($query)); 
    $items             =    $vip['visitip']; 
     
    if (empty($items)) 
    { 
        $query = "INSERT INTO #_counter (id, tm, ip) VALUES ('', '$now', '$ip')"; 
        $d->query($query); 
    } 
     
    $n                 =     $all_visitors; 
    $div = 100000; 
    while ($n > $div) { 
        $div *= 10; 
    } 

    $query             =    "SELECT COUNT(*) AS todayrecord FROM #_counter WHERE tm>'$daystart'"; 
    $todayrc  = mysql_fetch_assoc($d->query($query)); 
    $today_visitors     =    $todayrc['todayrecord']; 
     
    $query             =    "SELECT COUNT(*) AS yesterdayrec FROM #_counter WHERE tm>'$yesterdaystart' and tm<'$daystart'"; 
    $yesrec  = mysql_fetch_assoc($d->query($query)); 
    $yesterday_visitors     =    $yesrec['yesterdayrec'] + 97; 
         
    $query             =    "SELECT COUNT(*) AS weekrec FROM #_counter WHERE tm>='$weekstart'"; 
    $weekrec = mysql_fetch_assoc($d->query($query)); 
    $week_visitors     =    $weekrec['weekrec'] + 221; 

    $query             =    "SELECT COUNT(*) AS monthrec FROM #_counter WHERE tm>='$monthstart'"; 
    $monthrec  = mysql_fetch_assoc($d->query($query)); 
    $month_visitors     =    $monthrec['monthrec'] + 1725; 
     
    $counter = '<div class="counter">'; 
    if ($pretext != "") $counter .= '<div>'.$pretext.'</div>'; 
    // Show digit counter 
    if($s_digit){         
        $counter .= '<div style="text-align: center;">'; 
        while ($div >= 1) { 
            $digit = $n / $div % 10; 
           
            $n -= $digit * $div; 
            $div /= 10; 
        } 
        $counter .= '</div>'; 
    } 
     
    $counter         .=    '<div style="margin:0 auto;margin-left:20px; text-align:center"><table cellpadding="1" cellspacing="1" border="0" style="text-align: center; width: '.$widthtable.'%;"><tbody align="center">'; 
    // Show today, yestoday, week, month, all statistic 
	if($s_all)            $counter        .=    spaceer("right.gif", $all, $all_visitors); 
    if($s_today)        $counter        .=    spaceer("right.gif", $today, $today_visitors); 
    if($s_yesterday)    $counter        .=    spaceer("right.gif", $yesterday, $yesterday_visitors); 
    if($s_week)            $counter        .=    spaceer("right.gif", $x_week, $week_visitors); 
    if($s_month)        $counter        .=    spaceer("right.gif", $x_month, $month_visitors); 
    
     
    $counter        .= "</tbody></table></div>"; 
    $counter .= "</div>"; 

    if ($posttext != "") $counter        .= '<div>'.$posttext.'</div>'; 

function spaceer($a1,$a2,$a3) 
{ 
    global $config; 
    $ret = "<tr style=\"text-align:left;\"> 
            <td width=\"20\"><img src=\"".$config['weburl']."".$a1."\" alt=\"Visitor\"/></td>"; 
    $ret .= "<td width=\"60\">".$a2."</td>"; 
    $ret .="<td width=\"20\" style=\"text-align:right;\">".$a3."</td></tr>"; 
    return $ret; 
} 
?>