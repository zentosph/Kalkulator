<style>
        .card {
            height: auto;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        h4 > a {
            color: blue;
            text-decoration: none;
        }

        h4 > a:hover {
            text-decoration: underline;
        }

        .content-body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container-fluid {
            max-width: 1200px;
            margin: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-4 {
            flex: 0 0 33.333%;
            padding: 10px;
        }

        .dashboard-title {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title">Selamat Datang, <?= session()->get('nama') ?></h4>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard content -->
           
        </div>
    </div>