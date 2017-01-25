<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Liegenschaftsverwaltung</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
					<a class="dropdown-toggle" href="#">Arbeit</a>
						<ul class="dropdown-menu">
							<li><a href="../sites/capturejob.php?error=">Erfassen</a></li>
							<li><a href="../sites/editjob.php?error=">Bearbeiten</a></li>
						</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown" href="#contact">Liegenschaft</a>
						<ul class="dropdown-menu">
							<li><a href="../sites/allliegenschaften.php">Alle Liegenschaften</a></li>
							<li><a href="../sites/showjobs.php">Arbeiten anzeigen</a></li>
						</ul>
				</li>
                <li class="dropdown">
					<a class="dropdown-toggle" href="#about">Neu</a>
						<ul class="dropdown-menu">
							<li><a href="../sites/liegenschaft.php?error=">Liegenschaft</a></li>
							<li><a href="../sites/task.php?error=">Aufgabe</a></li>
							<li><a href="../sites/arbeiter.php?error=">Mitarbeiter</a></li>
							<li><a href="../sites/ort.php?error=">Ort</a></li>
							<li><a href="../sites/typ.php?error=">Typ</a></li>
						</ul>
				</li>
                <li><a href="../sites/mitarbeiter.php">Mitarbeiter</a></li>
            </ul>
        </div>
    </div>
</nav>