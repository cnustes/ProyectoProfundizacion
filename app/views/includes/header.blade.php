<link rel="shortcut icon"  type="image/png" href="http://www.uniajc.edu.co/images/favicon.ico" />

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="principal">Main</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} &nbsp; <a href="logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav> 