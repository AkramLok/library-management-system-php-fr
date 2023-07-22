<meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <meta name="referrer" content="strict-origin" />
        <script src="https://kit.fontawesome.com/205f5ed30e.js" crossorigin="anonymous"></script>
        <style>
        ::-webkit-scrollbar {
          width: 8px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
          background: #f1f1f1; 
        }
          
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #888; 
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #555; 
        } 
        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
        body{font-family: 'Poppins', sans-serif;background: #fafafa}
        p{font-size: 1.1em;font-weight: 300;line-height: 1.7em;color:#999}
        a, a:hover, a:focus{color:inherit;text-decoration: none;transition: all 0.3s}
        .navbar{padding:15px 10px;background: #fff;border:none;border-radius: 0;margin-bottom: 40px;box-shadow: 1px 1px 3px rgba(0,0,0,0.1)}
        .navbar-btn{box-shadow: none;outline:none !important;border:none}
        .line{width:100%;height:1px;border-bottom: 1px dashed #ddd}
        .wrapper{display: flex;width:100%;align-items:stretch}
        #sidebar{min-width:300px;max-width: 300px;background: #0066A3;color:#fff;transition: all 0.3s;}
        #sidebar.active{margin-left:-300px}
        .sidebar-header{text-align:center}
        #sidebar .sidebar-header{padding:20px;background: ##0066A3}
        #sidebar ul.components{padding:20px 0px;border-bottom:1px solid #47748b}
        #sidebar ul p{padding:10px;font-size:15px;display: block;color:#fff}
        #sidebar ul li a{padding:10px;font-size: 1.1em;display: block}
        #sidebar ul li a:hover{color:#fff;background: #318fb5}
        #sidebar ul li.active>a, a[aria-expanded="true"]{color:#fff;background: #318fb5}
        a[data-toggle="collapse"]{position: relative}
        .dropdown-toggle::after{display: block;position: absolute;top:50%;right:20px;transform: translateY(-50%)}
        ul ul a{font-size:0.9em !important;padding-left: 30px !important;background: #318fb5}
        ul.CTAs{padding:20px}
        ul.CTAs a{text-align: center;font-size:0.9em !important;display: block;border-radius: 5px;margin-bottom:5px}
        a.download, a.download:hover{background:#318fb5;color:#fff}
        #content{width:100%;padding:20px;min-height: 100vh;transition: all 0.3s}
        .content-wrapper{padding:15px}
        @media(maz-width:768px)
        {
          #sidebar{margin-left:-250px}
          #sidebar.active{margin-left:0px}
          #sidebarCollapse span{display:none}
        }
        </style>