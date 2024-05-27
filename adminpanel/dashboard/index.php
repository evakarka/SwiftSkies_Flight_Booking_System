<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwiftSkies - Admin Dashboard</title>
    <link rel="shortcut icon" href="assets/imgs/aircraft-logo.png" type="image/svg+xml">
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<!-- Navigation -->
<div class="container-fluid padding_zero">
    <div class="navigation">
    <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li>
                <a href="./index.php">
                    <span class="icon">
                        <img src="assets/imgs/logo.png" alt="logo" style="height: 30px;">
                    </span>
                    <span class="title">SwiftSkies</span>
                </a>
            </li>

            <li>
                <a href="index.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="passengers.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Passengers</span>
                </a>
            </li>

            <li>
                <a href="flights.php">
                    <span class="icon">
                        <ion-icon name="airplane-outline"></ion-icon>
                    </span>
                    <span class="title">Flights</span>
                </a>
            </li>

            <li>
                <a href="airplanes.php">
                    <span class="icon">
                        <ion-icon name="airplane-outline" style="transform: rotate(-45deg);"></ion-icon>
                    </span>
                    <span class="title">Airplanes</span>
                </a>
            </li>

            <li>
                <a href="staff.php">
                    <span class="icon">
                        <ion-icon name="person-outline">></ion-icon>
                    </span>
                    <span class="title">Staff</span>
                </a>
            </li>

            <li>
                <a href="city.php">
                    <span class="icon">
                        <ion-icon name="globe-outline">></ion-icon>
                    </span>
                    <span class="title">City</span>
                </a>
            </li>

            <li>
                <a href="register.php">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Admin Panel</span>
                </a>
            </li>

            <li>
                <a href="help.php">
                    <span class="icon">
                        <ion-icon name="help-outline"></ion-icon>
                    </span>
                    <span class="title">Help</span>
                </a>
            </li>

            <li>
                <a href="setting.php">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>

            <li>
                <a href="password.php">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Password</span>
                </a>
            </li>

            <li>
                <a href="signout.php">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Flights</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="airplane-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Passenger</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$37,842</div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Flight ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Fligts</h2>
                        <a href="#" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>AIRLINE_NAME</td>
                                <td>FLIGHTNUM</td>
                                <td>ORIGIN</td>
                                <td>DEST</td>
                                <td>ARR-TIME</td>
                                <td>DEP-TIME</td>
                                <td>AIRPLANE_ID</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            
                            <tr>
                                <td>Nirgin Atlantic</td>
                                <td>VS41</td>
                                <td>LHR</td>
                                <td>SFO</td>
                                <td>2024-06-29</td>
                                <td>20:05:00</td>
                                <td>10:10:00</td>
                                <td><span class="status delivered">Landing</span></td>
                            </tr>
                            
                            <tr>
                                <td>RYANAIR</td>
                                <td>RK2584</td>
                                <td>LPA</td>
                                <td>MAN</td>
                                <td>2024-06-29</td>
                                <td>19:35:00</td>
                                <td>23:55:00</td>
                                <td><span class="status delivered">Landed</span></td>
                            </tr>
                            
                            <tr>
                                <td>Jet2</td>
                                <td>LS530</td>
                                <td>FNC</td>
                                <td>NCL</td>
                                <td>2024-06-29</td>
                                <td>20:20:00</td>
                                <td>00:35:00</td>
                                <td><span class="status return">Delayed</span></td>
                            </tr>

                            <tr>
                                <td>RYANAIR</td>
                                <td>FR1115</td>
                                <td>REU</td>
                                <td>DUB</td>
                                <td>2024-06-29</td>
                                <td>22:45:00</td>
                                <td>00:25:00</td>
                                <td><span class="status return">Cancelled</span></td>
                            </tr>



                            
                            <tr>
                                <td>Transavia</td>
                                <td>HV6892</td>
                                <td>ATH</td>
                                <td>AMS</td>
                                <td>2024-06-29</td>
                                <td>10:55:00</td>
                                <td>12:25:00</td>
                                <td><span class="status inProgress">In-flight</span></td>
                            </tr>

                            <tr>
                                <td>Emirates</td>
                                <td>EK4</td>
                                <td>LHR</td>
                                <td>DXB</td>
                                <td>2024-06-29</td>
                                <td>20:40:00</td>
                                <td>06:56:00</td>
                                <td><span class="status pending">Boarding</span></td>
                            </tr>

                            <tr>
                                <td>BRITISH AIRWAYS</td>
                                <td>BA634</td>
                                <td>LHR</td>
                                <td>ATH</td>
                                <td>2024-06-29</td>
                                <td>20:22:00</td>
                                <td>02:06:00</td>
                                <td><span class="status delivered">Landing</span></td>
                            </tr>

                            <tr>
                                <td>discover airlines</td>
                                <td>4Y132</td>
                                <td>FRA</td>
                                <td>WDH</td>
                                <td>2024-06-29</td>
                                <td>21:55:00</td>
                                <td>08:20:00</td>
                                <td><span class="status inProgress">In-flight</span></td>
                            </tr>

                            <tr>
                                <td>AIR CANADA</td>
                                <td>AC114</td>
                                <td>YVR</td>
                                <td>YYZ</td>
                                <td>2024-06-29</td>
                                <td>13:04:00</td>
                                <td>20:27:00</td>
                                <td><span class="status pending">Boarding</span></td>
                            </tr>

                            <tr>
                                <td>United Airlines</td>
                                <td>UA1596</td>
                                <td>SFO</td>
                                <td>HNL</td>
                                <td>2024-06-29</td>
                                <td>13:41:00</td>
                                <td>16:04:00</td>
                                <td><span class="status return">Cancelled</span></td>
                            </tr>

                            <tr>
                                <td>DELTA</td>
                                <td>DL389</td>
                                <td>DTW</td>
                                <td>PVG</td>
                                <td>2024-06-29</td>
                                <td>10:09:00</td>
                                <td>12:46:00</td>
                                <td><span class="status inProgress">In-flight</span></td>
                            </tr>

                            <tr>
                                <td>DELTA</td>
                                <td>DL275</td>
                                <td>DTW</td>
                                <td>HND</td>
                                <td>2024-06-29</td>
                                <td>14:04:00</td>
                                <td>15:56:00</td>
                                <td><span class="status inProgress">In-flight</span></td>
                            </tr>

                            <tr>
                                <td>QANTAS</td>
                                <td>QF10</td>
                                <td>LHR</td>
                                <td>PER</td>
                                <td>2024-06-29</td>
                                <td>11:57:00</td>
                                <td>11:23:00</td>
                                <td><span class="status return">Cancelled</span></td>
                            </tr>

                            <tr>
                                <td>Lufthansa</td>
                                <td>LH716</td>
                                <td>FRA</td>
                                <td>HND</td>
                                <td>2024-06-29</td>
                                <td>14:24:00</td>
                                <td>09:57:00</td>
                                <td><span class="status pending">Delayed</span></td>
                            </tr>

                            <tr>
                                <td>United Airlines</td>
                                <td>UA39</td>
                                <td>LAX</td>
                                <td>HND</td>
                                <td>2024-06-29</td>
                                <td>12:04:00</td>
                                <td>15:08:00</td>
                                <td><span class="status inProgress">In-flight</span></td>
                            </tr>

                            <tr>
                                <td>Emirates</td>
                                <td>EK412</td>
                                <td>SYD</td>
                                <td>CHC</td>
                                <td>2024-06-29</td>
                                <td>07:55:00</td>
                                <td>12:51:00</td>
                                <td><span class="status delivered">Landing</span></td>
                            </tr>

                            <tr>
                                <td>QANTAS</td>
                                <td>EK412</td>
                                <td>JNB</td>
                                <td>SYD</td>
                                <td>2024-07-01</td>
                                <td>17:49:00</td>
                                <td>13:44:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>

                            <tr>
                                <td>United Airlines</td>
                                <td>UA893</td>
                                <td>SFO</td>
                                <td>ICN</td>
                                <td>2024-07-01</td>
                                <td>11:09:00</td>
                                <td>15:41:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>


                            <tr>
                                <td>Aegean Airlines</td>
                                <td>A123</td>
                                <td>ATH</td>
                                <td>JFK</td>
                                <td>2024-08-08</td>
                                <td>10:00:00</td>
                                <td>12:10:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>
    
                            <tr>
                                <td>United Airlines</td>
                                <td>F1234</td>
                                <td>JFK</td>
                                <td>ATH</td>
                                <td>2024-09-20</td>
                                <td>20:05:00</td>
                                <td>10:10:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>
    
                            <tr>
                                <td>Aegean Airlines</td>
                                <td>F4567</td>
                                <td>ATH</td>
                                <td>CDG</td>
                                <td>2024-07-06</td>
                                <td>15:00:00</td>
                                <td>17:00:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>
    
                            <tr>
                                <td>Transavia</td>
                                <td>F891</td>
                                <td>ATH</td>
                                <td>CDG</td>
                                <td>2024-07-13</td>
                                <td>21:00:00</td>
                                <td>23:00:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>
    
                            <tr>
                                <td>United Airlines</td>
                                <td>F1234</td>
                                <td>JFK</td>
                                <td>ATH</td>
                                <td>2024-09-20</td>
                                <td>18:20:00</td>
                                <td>20:57:00</td>
                                <td><span class="status pending">Awaiting</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Staff</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://www.bristol.gs/wp-content/uploads/2020/03/iStock-1145774803-scaled-e1622041367598.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Olivia</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://media.istockphoto.com/id/200258862-001/photo/air-steward-standing-in-aisle-of-aeroplane-smiling-portrait.jpg?s=612x612&w=0&k=20&c=If6Jf0sl_PoWnS0LU8bJLJAfHnuK2laZoiLEIn6VtzA=" alt=""></div>
                            </td>
                            <td>
                                <h4>James</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/4/3/2/4328b299-d882-4ae8-913d-b2d8faf5f587_large/pilot-above-clouds-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>William</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://www.perfocal.com/blog/content/images/size/w960/2021/01/Perfocal_17-11-2019_TYWFAQ_100_standard-3.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Charlotte</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://static.boredpanda.com/blog/wp-content/uploads/2019/06/boss-criticizes-women-photo-sexual-harassment-5d09e795c4167__700.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Amelia</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/9/f/8/9f8f02c3-4a37-429d-9d2c-266efea6d4af_large/pilot-at-controls-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Thomas</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://www.ebony.com/wp-content/uploads/2022/02/09/carole-hopson-united-airlines-black-pilot-image.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Sophia</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://en.life-in-germany.de/wp-content/uploads/2023/07/absender_a_happy_stewardess_working_in_a_bright_and_colorful_a_8348e23b-eeb8-41a7-a86e-50b14879fea9-updraft-pre-smush-original.jpeg" alt=""></div>
                            </td>
                            <td>
                                <h4>Mia</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/b/d/0/bd0c6c60-ae06-49a9-a98c-74807203849c_large/catering-service-smile-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Isabella</h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/a/8/c/a8cd5f30-5142-4953-aa80-6769f09a23ff_large/friendly-staff-member-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Ava</h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/6/b/8/6b80dd0f-fef6-4e36-a275-c02e7fed3cd5_large/bellhop-with-luggage-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>David</h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/2/5/d/25d3a171-d82f-47c5-abac-085378233a24_large/security-checkpoint-duty-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Luna</h4>
                            </td>
                        </tr>
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/0/3/6/036d21c9-8cfa-43f6-8dcb-9f9858553694_large/proud-flight-attendant-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Sofia</h4>
                            </td>
                        </tr>
                        
                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/5/0/f/50fe8462-345d-421a-a2de-c909b852614d_large/confident-flight-attendant-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Robert</h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx"><img src="https://images.stockcake.com/public/b/f/7/bf7ae7b7-a6f6-47ce-85d3-7dcf87ea7c1f_large/smiling-cabin-crew-stockcake.jpg" alt=""></div>
                            </td>
                            <td>
                                <h4>Eleanor</h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>