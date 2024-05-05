<style>
    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: #f1f1f1;
      /* position: fixed; */
      height: 100%;
      overflow: auto;
    }

    .sidebar a {
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
    }

    .sidebar a.active {
      background-color: #04AA6D;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }
    .profile-img{
        width: 30px;
    }


    .topnav {
    overflow: hidden;
    background-color: #e9e9e9;
    margin-left: 200px;
    padding-left: 10px;
    }

    .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .topnav a:hover {
    background-color: #ddd;
    color: black;
    }

    .topnav a.active {
    background-color: #2196F3;
    color: white;
    }

    .topnav .search-container {
    float: right;
    }

    .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
    }

    .topnav .search-container button {
    float: right;
    padding: 6px;
    margin-top: 8px;
    margin-right: 16px;
    background: #ddd;
    font-size: 17px;
    border: none;
    cursor: pointer;
    }

    .topnav .search-container button:hover {
    background: #ccc;
    }

    .navbar {
        margin-bottom: 0!important;
    }
</style>
