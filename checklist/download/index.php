<?php
require_once("/students/15080900/projectapp/php/initalise.php");
require_once($root.'php/pdf/tcpdf.php');
require_once($root.'php/checklist/checklistClass.php');
require_once($root.'php/user/userClass.php');
require_once($root.'php/checklist/checklistAmendmentClass.php');
require_once($root.'php/drone/droneClass.php');



if(!isset($_SESSION['user']) || !isset($_GET['checklistID']))
{
    //header('location: '.$root);
  // die();
}

$checklist = new checklist();

$rOverview = $checklist->getChecklistOverview($_GET['checklistID']);
if($rOverview->num_rows > 0)
{
    $overview = $rOverview->fetch_assoc();

    //check user owns checklist
    if($overview['UserID'] != $_SESSION['user'])
    {
        header('location: '.$root);
        die();
    }
    $user = new user();
    $userDetails = $user->getUserDetails($_SESSION['user']);
    
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator($userDetails['Name']);
    $pdf->SetAuthor($userDetails['Name']);
    $pdf->SetTitle($overview['ChecklistName']);
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // set header/footer
    $pdf->SetHeaderData(null, 0, $overview['ChecklistName'], $userDetails['Name'], array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
    
    $pdf->SetFont('helvetica', '', 14, '', true);
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    //
    //Page 1
    //
    $pageTitle = $overview['ChecklistName'];
    $creator = $userDetails['Name'];
    $plannedDate = $overview['PlannedDate'];
    $html = <<<EOD
    <div style="top:250px;text-align:center">
    <br><br><br><br>
    <h1 align="center" style="margin-top:50px;">$pageTitle</h1>
    <p>Flight Date: $plannedDate </p>
    <h2>$creator</h2>
    </div>
EOD;
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->AddPage();
    //
    //page 2(amendments)
    //
    $amendment = new checklistAmenment();
    $amendmentList = $amendment->selectChecklistAmendments($_GET['checklistID']);
    $html = "<h2 align='center'>Amendment record</h2>";
    
    $html .='<table border="1" cellspacing="0" cellpadding="4">';
    $html .="<tr><th style='border:1px solid black;'>Amendment No.</th><th>Amendment Date</th></tr>";
    while($amendment = $amendmentList->fetch_assoc())
    {
        $html .="<tr>";
        $html .="<td style='border:1px solid black;'>".$amendment['AmendmentNo']."</td>";
        $html .="<td style='border:1px solid black;'>".$amendment['AmendmentDate']."</td>";
        $html .="</tr>";
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();
    //
    //Contents 
    //
    //
    /*$html = '<h2>Contents</h2>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();*/
    //
    //Drone
    //
    $html = '<h2>Drone Specifications</h2>';
    $drone= new drone();
    $rDrone = $drone->getFullDetails($overview['DroneID'],$_SESSION['user']);
    $droneDetails = $rDrone->fetch_assoc();
    $droneHeaders = array_keys($droneDetails);
    
    //HTML
    
    $html .='<table border="1" cellspacing="0" cellpadding="4">';
    $html .='<tr><th>Item</th><th>specification</th></tr>';
    foreach ($droneHeaders as $header) {
        if($header != 'imgSrc' || $header != 'DroneID')
        {
            $html .= '<tr>';
            $html .= '<td>'.$header.'</td>';
            $html .= '<td>'.$droneDetails[$header].'</td>';
            $html .= '</tr>';
        }
    }
    $html .= '</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();
    //
    //Checklist
    //
    $html = '<h2>Checklist</h2>';
    $html .= '<br>';
    $html .= '<p>Planned date: '. $overview['PlannedDate'] . "</p>";
    $html .= '<br>';
    $html .= '<p>'.$overview['Descr']."</p>";
    $pdf->writeHTML($html, true, false, true, false, '');
    //
    //Loading List
    //
    $result = $checklist->getLoadingList($_GET['checklistID']);
    $headers = array_keys($result);
    $html = '<h3>Section 1 - loading list</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">';
    $html .= '<tr><th>item</th><th>Checked</th></tr>';
    foreach($headers as $header)
    {
        if($header != "ChecklistID")
        {
            if($header != "userID")
            {
                $html .= "<tr>";
                $html .= "<td>".$header."</td>";
                $html .= "<td>".$result[$header]."</td>";
                $html .= "</tr>";
            }
        }
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();
    //
    //PreFlight
    //
    $result = $checklist->getPreFlight($_GET['checklistID']);
    $headers = array_keys($result);
    $html = '<h3>Section 2 - preFlight</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">';
    $html .= '<tr><th>item</th><th>Checked</th></tr>';
    foreach($headers as $header)
    {
        if($header != "ChecklistID")
        {
            if($header != "userID")
            {
                $html .= "<tr>";
                $html .= "<td>".$header."</td>";
                $html .= "<td>".$result[$header]."</td>";
                $html .= "</tr>";
            }
        }
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();

    //
    //Post Take Off
    //
    $result = $checklist->getPostTakeOff($_GET['checklistID']);
    $headers = array_keys($result);
    $html = '<h3>Section 3 - Post Take Off</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">';
    $html .= '<tr><th>item</th><th>Checked</th></tr>';
    foreach($headers as $header)
    {
        if($header != "ChecklistID")
        {
            if($header != "userID")
            {
                $html .= "<tr>";
                $html .= "<td>".$header."</td>";
                $html .= "<td>".$result[$header]."</td>";
                $html .= "</tr>";
            }
        }
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();

     //
    //PreLanding
    //
    $result = $checklist->getPreLanding($_GET['checklistID']);
    $headers = array_keys($result);
    $html = '<h3>Section 4 - Pre-Landing</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">';
    $html .= '<tr><th>item</th><th>Checked</th></tr>';
    foreach($headers as $header)
    {
        if($header != "ChecklistID")
        {
            if($header != "userID")
            {
                $html .= "<tr>";
                $html .= "<td>".$header."</td>";
                $html .= "<td>".$result[$header]."</td>";
                $html .= "</tr>";
            }
        }
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->AddPage();

     //
    //PreTakeOff
    //
    $result = $checklist->getPostLanding($_GET['checklistID']);
    $headers = array_keys($result);
    $html = '<h3>Section 5 - Post Landing</h3>';
    $html .= '<table border="1" cellspacing="0" cellpadding="4">';
    $html .= '<tr><th>item</th><th>Checked</th></tr>';
    foreach($headers as $header)
    {
        if($header != "ChecklistID")
        {
            if($header != "userID")
            {
                $html .= "<tr>";
                $html .= "<td>".$header."</td>";
                $html .= "<td>".$result[$header]."</td>";
                $html .= "</tr>";
            }
        }
    }
    $html .= "</table>";
    $pdf->writeHTML($html, true, false, true, false, '');
   

    //output file 
    $pdf->Output('example_001.pdf', 'I');
    











}





?>