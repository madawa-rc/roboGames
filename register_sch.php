<?php
$url = 'https://docs.google.com/forms/d/1KTj4axkC3XoayoEKx4Z7nnJ-1CDmboIeA-RKDTNu9Xo/formResponse';

$data = array(

'entry.1710849621' => $_POST['school_name'],
'entry.949849506' => $_POST['school_phone'],
'entry.225514547' => $_POST['school_address'],
'entry.160523876' => $_POST['teacher_incharge'],
'entry.1486059868' => $_POST['teacher_email'],
'entry.1952517285' => $_POST['teacher_phone'],
'entry.687148051' => $_POST['team_name'],
'entry.1867126740' => $_POST['group_leader'],
'entry.2018393908' => $_POST['leader_phone'],
'entry.1692092605' => $_POST['leader_mail'],
'entry.282531508' => $_POST['member1_name'],
'entry.1797648249' => $_POST['member1_phone'],
'entry.1456711646' => $_POST['member2_name'],
'entry.1462733528' => $_POST['member2_phone'],
'entry.826316787' => $_POST['member3_name'],
'entry.1586768785' => $_POST['member3_phone'],
'entry.1775439923' => $_POST['member4_name'],
'entry.913528380' => $_POST['member4_phone']

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

$mail = new PHPMailer;

$mail->isSMTP(); // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com'; // Specify main and backup server
$mail->Port = 587;
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = 'SMTP_USERNAME'; // SMTP username
$mail->Password = 'SMTP_PASSWORD'; // SMTP password
$mail->SMTPSecure = 'tls'; // Enable encryption, 'ssl' also accepted

$mail->AddReplyTo('REPLY_TO_EMAIL');
$mail->From = 'FROM_EMAIL';
$mail->FromName = 'IESL Robo Games 2014';
$mail->addAddress($_POST['leader_mail']);

$mail->isHTML(true);
$mail->Subject = 'IESL Robogames 2014';
$mail->Body = 'Dear '.$_POST['group_leader'].', <br/><br/>'.
    'You have successfully registered for IESL roboGames. <br/><br/>'.
    '<strong>School Name</strong>  : '.$_POST['school_name'].'<br/>'.
    '<strong>Team Name</strong>  : '.$_POST['team_name'].'<br/>'.
    'Leader Name : '.$_POST['group_leader'].'<br/>'.
    'Member Name : '.$_POST['member1_name'].'<br/>'.
    'Member Name : '.$_POST['member2_name'].'<br/>'.
    'Member Name : '.$_POST['member3_name'].'<br/>'.
    'Member Name : '.$_POST['member4_name'].'<br/><br/>'.
    'Keep in touch with our <a href="https://www.facebook.com/IESL.RoboCompetition">Facebook</a> page for updates.<br/><br/>'.
    'Thanking You,<br/>'.
    'Organizing Committee,<br/>'.
    'IESL Robogames 2014';

$mail->AltBody =  'Dear '.$_POST['group_leader'].', <br/><br/>'.
    'You have successfully registered for IESL roboGames. <br/><br/>'.
    '<strong>School Name</strong>  : '.$_POST['school_name'].'<br/>'.
    '<strong>Team Name</strong>  : '.$_POST['team_name'].'<br/>'.
    'Leader Name : '.$_POST['group_leader'].'<br/>'.
    'Member Name : '.$_POST['member1_name'].'<br/>'.
    'Member Name : '.$_POST['member2_name'].'<br/>'.
    'Member Name : '.$_POST['member3_name'].'<br/>'.
    'Member Name : '.$_POST['member4_name'].'<br/><br/>'.
    'Keep in touch with our <a href="https://www.facebook.com/IESL.RoboCompetition">Facebook</a> page for updates.<br/><br/>'.
    'Thanking You,<br/>'.
    'Organizing Committee,<br/>'.
    'IESL Robogames 2014';

if(!$mail->send()) {
    header("location:index.htm?status=0");
}

header("Location: index.htm");
