<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Volkstuin Vereniging Sittard</title>
    <link rel="stylesheet" href="..\Admin\CSS-Admin\verzoek-naam.css">
    
</head>
<body>

<div class="header">
    VOLKSTUIN VERENIGING SITTARD
</div>



<div class="main-container">
    
    <div class="verticaal"></div>
    <div class="content">
        <div class="horizontaal"></div><br>
            <form action="" method="">
                <input type="text"     name="straatnaam"   placeholder="Straatnaam"        class="input-email">                    <br>
                <input type="text"     name="postcode"     placeholder="Postcode"          class="input-text">
                <input type="number"   name="huis"         placeholder="Huisnummer"        class="input-house" inputmode="numeric"><br>
                <input type="number"   name="telefoon"     placeholder="Telefoonnummer"    class="input-number">                   <br><br><br><br><br><br><br><br><br><br>

            </form>
        
            
            <div class="complex">
                <h2>Complex</h2>
                    <form method="">
                        <input type="text" name="complex"  placeholder="Complex 1"  value=""    class="complex-input"><br>
                        <input type="text" name="data"     placeholder="Complex 2"  value=""    class="complex-input">
                    </form><br><br><br><br><br><br><br><br><br>

                    <h2>Motivatie</h2>
                    <div class="motivatie">
                        
                            <p> 
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, quaerat accusamus nulla odio incidunt repellendus aspernatur?
                            Necessitatibus dolores excepturi possimus tempore?
                            Nobis, aperiam veniam temporibus odio perferendis debitis molestias tenetur?
                            amet consectetur adipisicing elit. sed voluptate, quasi iste doloribus veniam, aliquid similique possimus commodi amet 
                            distinctio voluptatum dolore vel dolor officiis aperiam itaque sit, non accusamus.
                            </p>
                    </div>

            </div>

            <button class="verstuur-button" id="open">Accepteren</button>
            <input type="submit" class="wijzigenbutton" value="Weigeren">
        

        
    </div>

    <div class="sidebar">
    <img src="../../Frontend/Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
    <div class="Icoontjes">

        <a href="dashboard.php">
            <div class="icon1">
                <img src="../../Frontend/Gedeeld/pictures/HomeMenuButton.svg" alt="huisknop">
            </div>
        </a>
        <a href="../../Frontend/Gedeeld/GebruikerInfo.php">
            <div class="icon2">
                <img src="../../Frontend/Gedeeld/pictures/UserMenuButton.svg" alt="settings">
            </div>
        </a>
        <a href="../../Frontend/login.php">
            <div class="icon3">
                
                <img src="../../Frontend/Gedeeld/pictures/ExitMenuButton.svg" alt="uitloggen">
            </div>
        </a>
    </div>

</div>

</body>
</html>
