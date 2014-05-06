<?php
$url = 'https://docs.google.com/forms/d/1bDPN4lRYbUNQuHuHMNjWeYRXO9H_Jw8xIcTf8xp212g/formResponse';

$data = array('entry.225514547' => $_POST['university_name'],
'entry.1710849621' => $_POST['university_name'],
'entry.687148051' => $_POST['team_name'],
'entry.1867126740' => $_POST['group_leader'],
'entry.1692092605' => $_POST['leader_phone'],
'entry.2018393908' => $_POST['leader_mail'],
'entry.2018393908' => $_POST['leader_mail'],
'entry.282531508' => $_POST['member1_name'],
'entry.1043624897' => $_POST['member1_mail'],
'entry.1456711646' => $_POST['member2_name'],
'entry.2075388500' => $_POST['member2_mail'],
'entry.826316787' => $_POST['member3_name'],
'entry.977271117' => $_POST['member3_mail'],
'entry.1775439923' => $_POST['member4_name'],
'entry.524731080' => $_POST['member4_mail']


);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
header("Location: index.htm");
