<?php
require_once '../Backend/DatabaseContext/Database.php';

// Database connection
$connection = new mysqli("localhost", "root", "", "Volkstuinen"); // Update database name

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Operating user
$myUserID = 111;
$openChat = FALSE;

if (isset($_GET["partnerName"])) {
    // Validate user input
    $partnerName = trim($_GET["partnerName"]);

    if (preg_match('/^[A-Za-z\d]{3,64}$/', $partnerName)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $connection->prepare("SELECT usr.id, usr.user_name,
            (SELECT cht.id FROM userchat cht WHERE cht.chat_owner = ? AND cht.chat_partner = usr.id) AS chat_id
            FROM useraccount usr WHERE usr.user_name = ? AND usr.id != ? LIMIT 1");
        $stmt->bind_param("isi", $myUserID, $partnerName, $myUserID);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $row = $res->fetch_assoc();

            // Store retrieved values
            $partnerName = $row["user_name"];
            $partnerUserID = intval($row["id"]);
            $myChatID = intval($row["chat_id"]);
            $openChat = TRUE;
        } else {
            $errorFeedback = phpFeedback("error", "User name not found!");
        }

        $stmt->close();
    } else {
        $errorFeedback = phpFeedback("error", "User name does not exist!");
    }
}

// Ensure a chat exists before inserting messages
if ($openChat) {
    if ($myChatID === 0) {
        // Create chat for both users
        $stmt = $connection->prepare("INSERT INTO userchat (chat_owner, chat_partner, last_action, created_at) VALUES (?, ?, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())");
        $stmt->bind_param("ii", $myUserID, $partnerUserID);
        $stmt->execute();
        $myChatID = $stmt->insert_id;
        $stmt->close();

        $stmt = $connection->prepare("INSERT INTO userchat (chat_owner, chat_partner, last_action, created_at) VALUES (?, ?, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())");
        $stmt->bind_param("ii", $partnerUserID, $myUserID);
        $stmt->execute();
        $partnerChatID = $stmt->insert_id;
        $stmt->close();
    }

    // Insert messages
    $stmt = $connection->prepare("INSERT INTO userchat_msg (chat_id, msg_owner, sender, recipient, msg_date, msg_status, msg_text) VALUES 
        (?, ?, ?, ?, UNIX_TIMESTAMP(), ?, ?), 
        (?, ?, ?, ?, UNIX_TIMESTAMP(), ?, ?)");
    $msg = "Hello there";
    $statusSent = 1;
    $statusReceived = 0;
    $stmt->bind_param("iiiiisiiiiis",
        $myChatID, $myUserID, $myUserID, $partnerUserID, $statusSent, $msg,
        $partnerChatID, $partnerUserID, $myUserID, $partnerUserID, $statusReceived, $msg
    );
    $stmt->execute();
    $stmt->close();
}


function phpFeedback($type, $message) {
    return "<div class='feedback {$type}'>{$message}</div>";
}


// Close database connection
$connection->close();

