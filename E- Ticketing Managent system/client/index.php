<?php


error_reporting(E_ALL);

// speed things up with gzip, also ob_start() is required for csv export
if(!ob_start('ob_gzhandler'))
    ob_start();

header('Content-Type: text/html; charset=utf-8');


echo "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='css/style.css'>  
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <script src='js/jquery-3.7.0.js'></script>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v4.0.0/css/line.css'>

    <title>CLIENT-IT Ticketing-</title> 
</head>
<body>
"; 

require ('inc/connection.php');
require ('inc/modules.php');



//echo "</body></html>";



?>


<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">Ministry of ICT</span>

        </div>

        <div class="menu-items">
            <ul class="tabs">
                <li><a href="#D0" class="active">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="#D2" >
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Tickets</span>
                </a></li>
                  <li><a href="#D3" >
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Reports</span>
                </a></li>
            

            </ul>

            <ul class="logout-mode">
                <li><a href="../membership/logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">

        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>


            <span class="logo_name"><h1> IT Ticketing System</h1></span>

           <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->
            
            <img src="" alt="">
        </div>

        <ul class="tabs-content"> 

            <li id="D0">

                <?php
////////////////////////// SELECT WHERE USERID IS CURRENT USER ///////////////////////////////////////////////////////// 
                $sqlQuery = "SELECT count(complaintid) as totalComplaints, 
                             count(if(status=2,1,null)) AS totalSolved,
                             count(if(status=0 || status=1 ,1,null)) AS totalPending
                FROM complaints";
                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                while( $data = mysqli_fetch_assoc($result) ) {
                $totalComplaints= $data['totalComplaints'];
                $totalSolved= $data['totalSolved'];
                $totalPending= $data['totalPending'];

                echo"       
                                    
                            <div class='dash-content' >
                            <div class='overview'>
                                <div class='title'>
                                    <i class='uil uil-tachometer-fast-alt'></i>
                                    <span class='text'>&UserName</span>
                                </div>

                                <div class='boxes'>
                                    <div class='box box1'>
                                        <i class='uil uil-files-landscapes'></i>
                                        <span class='text'>TOTAL TICKETS</span>
                                        <span class='number'>$totalComplaints</span>
                                    </div>
                                    <div class='box box2'>
                                        <i class='uil uil-files-landscapes'></i>
                                        <span class='text'>SOLVED TICKETS</span>
                                        <span class='number'>$totalSolved</span>
                                    </div>
                                    <div class='box box3'>
                                        <i class='uil uil-files-landscapes'></i>
                                        <span class='text'>PENDING TICKETS</span>
                                        <span class='number'>$totalPending</span>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                            ?>
                            <div class="activity">
                                <div class="title">
                                    <i class="uil uil-clock-three"></i>
                                    <span class="text">Recent Activity</span>
                                </div>

                                <div class="activity-data" >



                                    <?php
////////////////////////// SELECT WHERE USERID IS CURRENT USER ///////////////////////////////////////////////////////// 

                            $query = "SELECT ComplaintId, Description, complaints.Expert_assigned,users.Name, complaints.Status, Recipient_endtime FROM complaints LEFT JOIN users ON users.userID= complaints.Expert_assigned ORDER BY `ComplaintId` desc ";
                            $result = mysqli_query($conn, $query);


                            $complaints = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                            $complaints[] = $row;
                            }
                            ?>
        <!-- <div id='adminDashTable'> -->
            
        <!-- <div id='adminDashTable'> -->
            <div id="adminDash" style="width: 100%;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
            <th>TICKET ID</th>
            <th>Description</th>
            <th>Expert Assigned</th>
            <th>Status</th>
            <th>End Time</th>
            <th>Action</th>
        </tr>
        <?php foreach ($complaints as $complaint) : ?>
        <tr >
            <tr style="background:#fdfdfd" class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
            <td><?php echo $complaint['ComplaintId']; ?></td>
            <td><?php echo $complaint['Description']; ?></td>
            <td><?php 
            if ($complaint['Name']=='') {
            $Name ="None";
            } else {
            $Name= $complaint['Name'];
            } 
            echo $Name; ?></td>
            <td class="<?php echo ($complaint['Status'] === 0) ? 0 : 1; ?>">

                <?php 

                if ($complaint['Status']==0) {
            $Status ="Pending";
            } else if ($complaint['Status']==1) {
            $Status= "Assigned";
            } 
            else{
                $Status= "Completed";
            }
                echo $Status; ?></td>
                <td>
             <?php if ($complaint['Status'] == 0) : ?>
                <?php echo "Ticket is still open";?>

            <?php else: ?>
                <?php echo $complaint['Recipient_endtime']; ?>
                 <?php endif; ?>
            </td>
            <td>     
             <?php if ($complaint['Status'] == 0 && $complaint['Name'] != '') : ?>        
                <form id="markSolve" name="markSolve" >
                <input type="text" style="display: none;" id="issue" name="issue" value=<?php echo $complaint['ComplaintId']; ?>>
                                       
                <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Mark as Solved</button>
                </form>
                 <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
 </div>  
     <script>
    $( "#markSolve" ).on( "submit", function(e) {

    var dataString = $(this).serialize();

    // alert(dataString); return false;

    $.ajax({

      type: "POST",

      url: "inc/data.php",

      data: dataString,

       success: function(jqXHR, textStatus, errorThrown) {
        alert('Assigned successfully')
       // $("#contact_form").load(" #contact_form");
        // $("#contact_form").load(" #contact_form > *");
        $('#admindash').load(document.URL + ' #admindash');
           window.location.reload();
        // window.location.href = 'index.php#D2';
      }
    });

    e.preventDefault();

  });

</script>
                        </table>
                            </div>
                        </div>
            </li>
            <li id="D2">


                <div class="dash-content">

                     <?php
////////////////////////// SELECT WHERE DATE IS TODAY ///////////////////////////////////////////////////////// 
                $sqlQuery = "SELECT count(complaintid) as totalComplaints, 
                             count(if(status=2,1,null)) AS totalSolved,
                             count(if(status=1,1,null)) AS totalAssigned,
                             count(if(status=0,1,null)) AS totalPending
                FROM complaints ";
                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                while( $data = mysqli_fetch_assoc($result) ) {
                $totalComplaints= $data['totalComplaints'];
                $totalAssigned= $data['totalAssigned'];
                $totalSolved= $data['totalSolved'];
                $totalPending= $data['totalPending'];

                echo" 

                    <div class='overview'>
                        <div class='title'>
                            <i class='uil uil-tachometer-fast-alt'></i>
                            <span class='text'>Tickets</span>
                        </div>

                        <div class='boxes'>
                            <div class='box box3' >
                                <i class='uil uil-files-landscapes'></i>
                                <span class='text'>TICKETS</span>
                                <span class='number'>$totalComplaints</span>
                            </div>
                            <div class='box box2'>
                                <i class='uil uil-files-landscapes'></i>
                                <span class='text'>ASSIGNED</span>
                                <span class='number'>$totalAssigned</span>
                            </div>
                            <div class='box box1'>
                                <i class='uil uil-files-landscapes'></i>
                                <span class='text'>SOLVED</span>
                                <span class='number'>$totalSolved</span>
                            </div>
                            <div class='box box4'>
                                <i class='uil uil-files-landscapes'></i>
                                <span class='text'>UNASSAIGNED</span>
                                <span class='number'> $totalPending</span>
                            </div>
                        </div>
                    </div>
                    ";
                } 
                ?>


                    <div class="cssAnimsDemo">
                    <div class="tabWrap">
                    
                    
                    <!-- Links for Desktop -->

                    <input id="tabLink6" type="radio" name="tabs">
                    <label for="tabLink6" class="desktopTabLink" style="width: 32%;">Raise Ticket</label>            

                    <!-- Links for Mobile -->
                    <input id="tabLinkMobile6" type="radio" name="tabs">
                    <label for="tabLinkMobile6" class="mobileAccordionLink">Raise Ticket</label>

                    <!-- Content -->
                <article class="tabContent" id="tabContent6">
                <div class="activity">
                <div class="activity-data" >
                <div class="complaint" id="ticket">
                <form id="complaintS" name="complaintS"  >
                <center><h3>Fill in the user support form</h3></center>
                <input type="text" name="location" id="" placeholder="LOCATION" required>
                <textarea name="problemDescription" id="" cols="30" rows="10" placeholder="PROBLEM DESCRIPTION" required></textarea>
                <input type="text" name="department" placeholder="Department" list="department">
                <datalist id="department">
                <option value="IT"></option>
                <option value="ICT"></option>
                </datalist>
                <div class="myDeadline" >
                <label for="deadline" style="cursor: none; border: none; ">Deadline</label>
                <input type="datetime-local" name="deadline" placeholder="Deadline">
                </div>
                <label for="rangen" style="border: none;">Priority</label>
                <div style="display: inline-flex; margin: auto; ">
                
                <label for="rangen" style="border: none;">0 (Trivial)</label>
                <input type="range" name="priority" id="rangen" placeholder="" max="10" min="0" required>
                <label for="rangen" style="border: none;">10 (Urgent)</label>
                </div>
                <center>
                <button type="submit" name="submit">Submit</button>
                </center>
                </form>
    
  </div>

  <script>
    $( "#complaintS" ).on( "submit", function(e) {

    var dataString = $(this).serialize();

     //alert(dataString); return false;

    $.ajax({

      type: "POST",

      url: "inc/complaintsend.php",

      data: dataString,

       success: function(jqXHR, textStatus, errorThrown) {
        alert('Ticket submitted successfully')
        $('#complaintS').load(document.URL + ' #complaintS');
           //window.location.reload();
      }
    });

    e.preventDefault();

  });

</script>

                </div>
            </div>
                    </article>
                  </div>
                </div>
                </div>
            </li>
            <li id="D3">
                    <div class="dash-content">
                        <div class="overview">
                            <div class="title">
                                <i class="uil uil-tachometer-fast-alt"></i>
                                <span class="text">Reports</span>
                            </div>

                            <div class="boxes">
                                <div class="box box1">
                                    <i class="uil uil-files-landscapes"></i>
                                    <span class="text">TOTAL COMPLAINTS</span>
                                    <span class="number">15</span>
                                </div>
                                <div class="box box2">
                                    <i class="uil uil-files-landscapes"></i>
                                    <span class="text">SOLVED COMPLAINTS</span>
                                    <span class="number">10</span>
                                </div>
                                <div class="box box3">
                                    <i class="uil uil-files-landscapes"></i>
                                    <span class="text">PENDING COMPLAINTS</span>
                                    <span class="number">5</span>
                                </div>
                            </div>
                        </div>

                       <div class="cssAnimsDemo">
                  <div class="tabWrap">
                    
                    
                    <!-- Links for Desktop -->

                    <input id="tabLink8" type="radio" name="tabs">
                    <label for="tabLink8" class="desktopTabLink" style="width: 32%;">Tickets</label>

                    <input id="tabLink9" type="radio" name="tabs">
                    <label for="tabLink9" class="desktopTabLink" style="width: 32%;">Empty</label>

                  
                   
                    <!-- Links for Mobile -->
                    <input id="tabLink8" type="radio" name="tabs">
                    <label for="tabLink8" class="mobileAccordionLink">Tickets</label>
                    
                    <!-- Content -->
                    <article class="tabContent" id="tabContent8">
                        <table id="reportsTable1" class="table table-striped">
                            <thead>
                                <tr>
                                   <th>Id</th> 
                                   <th>Name</th>
                                    <th>User Type</th>
                                    <th>AOS</th>
                                    <th>Date Created</th>
                                    <th>Status</th>                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sqlQuery = "SELECT UserId, name, usertype, aos, date_created, status FROM users ";
                                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                                while( $emp = mysqli_fetch_assoc($result) ) {
                                ?>
                                    <tr id="<?php echo $emp ['UserId']; ?>">
                                       <td><?php echo $emp ['UserId']; ?></td>
                                       <td><?php echo $emp ['name']; ?></td>
                                       <td><?php echo $emp ['aos']; ?></td>            
                                       <td><?php echo $emp ['date_created']; ?></td>
                                       <td><?php echo $emp ['usertype']; ?></td> 
                                       <td><?php echo $emp ['status']; ?></td> 


                                   </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </article>
                    

                    <!-- Links for Mobile -->
                    <input id="tabLinkMobile9" type="radio" name="tabs">
                    <label for="tabLinkMobile9" class="mobileAccordionLink">Empty</label>

                    <!-- Content -->
                    <article class="tabContent" id="tabContent9">
                      <table id="reportsTable2" class="table table-striped" style="display: none;">
                            <thead>
                                <tr>
                                   <th>Id</th> 
                                   <th>Name</th>
                                    <th>User Type</th>
                                    <th>AOS</th>
                                    <th>Date Created</th>
                                    <th>Status</th>                    
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php 
                                $sqlQuery = "SELECT UserId, name, usertype, aos, date_created, status FROM users ";
                                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                                while( $emp = mysqli_fetch_assoc($result) ) {
                                ?>
                                    <tr id="<?php echo $emp ['UserId']; ?>">
                                       <td><?php echo $emp ['UserId']; ?></td>
                                       <td><?php echo $emp ['name']; ?></td>
                                       <td><?php echo $emp ['aos']; ?></td>            
                                       <td><?php echo $emp ['date_created']; ?></td>
                                       <td><?php echo $emp ['usertype']; ?></td> 
                                       <td><?php echo $emp ['status']; ?></td> 


                                   </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </article>
                  </div>
                </div>
                    </div>
            </li>

        </ul>


    </section>

<footer><center>Copyright <a href="http://www.ict.go.ke">The Ministry of ICT and Digital Economy</a></center></footer>
</body>

<script src="js/script.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.tabledit.js"></script>
<script src="js/editable.js"></script>

</html>
?>