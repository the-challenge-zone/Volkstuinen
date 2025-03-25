<?php
// Let's just say the operating user is:

$myUserID = 111;

// Indicates if the requested user exists, if not show the mailbox page.
$openChat = FALSE;

if(isset($_GET["partnerName"])) {

    // Validate user name
    $partnerName = trim($_GET["partnerName"]);

    if(preg_match('/^[A-Za-z\d]{3,64}$/' , $partnerName))
    {
        // User name valid, get info from database:
        // Check if username really exists and get the user ID and the name from database
        // Also check if a chat between the operating and the requested user exists, if yes get the chat ID
        // RESULT: id, user_name, chat_id (will be NULL if no chat exists)

        $res = $mysqli->query("SELECT usr.id, usr.user_name,
        (SELECT cht.id FROM userchat cht WHERE cht.chat_owner = $myUserID AND cht.chat_partner = usr.id) AS chat_id
        FROM useraccount usr WHERE usr.user_name = '$partnerName' AND usr.id != $myUserID LIMIT 1;");

        if($res->num_rows === 1) {

            $row = $res->fetch_assoc();

            // User name of chat partner will be visible in the chat, don't use the $_GET value
            $partnerName = $row["user_name"];
            $partnerUserID = intval($row["id"]);

            // Will be int (0) if no chat exists, yet
            $myChatID = intval($row["chat_id"]);
            $openChat = TRUE;

            // If $openChat is TRUE, you can use these 3 variables: $partnerName, $partnerUserID, $myChatID (can be 0)

        }
        else {

            // Requested user name is valid but not existant!
            $errorFeedback = phpFeedback("error", "User name not found!");

        }

    }
    else {

        // else: invalid user name requested, you can redirect to 404 page here for example.
        $errorFeedback = phpFeedback("error", "User name does not exist!");

    }

}