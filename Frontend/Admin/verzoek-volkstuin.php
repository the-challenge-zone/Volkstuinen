<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volkstuin Vereniging Sittard</title>
    <link rel="stylesheet" href="..\..\Frontend\Admin\CSS-Admin\verzoek-volkstuin.css">
</head>
<body>

<div class="header">
    VOLKSTUIN VERENIGING SITTARD
</div>
<div class="main-container">
    <div class="sidebar">
        <img src="../../Frontend/Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">
        <a href="dashboard.php"><img src="../../Frontend/Gedeeld/pictures/HomeMenuButton.svg" alt="Home"></a>
        <a href="../../Frontend/Gedeeld/GebruikerInfo.php"><img src="../../Frontend/Gedeeld/pictures/UserMenuButton.svg" alt="User"></a>
        <a href="../../Frontend/login.php"><img src="../../Frontend/Gedeeld/pictures/ExitMenuButton.svg" alt="Logout"></a>
    </div>

    <div class="content">
        <h1 class="titel">Verzoeken naar volkstuin</h1>
        <div class="horizontaal"></div><br>
            <form class="form" id="form1">
                <input type="text"      placeholder="Naam"      class="content-input">
                <input type="text"      placeholder="E-mail"    class="content-input">
                <input type="text"      placeholder="Datum"     class="content-input">
                <button type="submit" form="form1" value="" class="content-button">Verder Kijken</button>
            </form>

            <form class="form" id="form2">
                <input type="text"      placeholder="Naam"      class="content-input">
                <input type="text"      placeholder="E-mail"    class="content-input">
                <input type="text"      placeholder="Datum"     class="content-input">
                <button type="submit" form="form2" value="submit" class="content-button">Verder Kijken</button>
            </form>

            <form class="form" id="form3">
                <input type="text"      placeholder="Naam"      class="content-input">
                <input type="text"      placeholder="E-mail"    class="content-input">
                <input type="text"      placeholder="Datum"     class="content-input">
                <button type="submit" form="form3" value="submit" class="content-button">Verder Kijken</button>
            </form>
      
</div>

</body>
</html>
