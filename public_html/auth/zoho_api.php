<?php
function add_to_zoho_leads($name, $email, $mobile, $hashed_password) {
    $token = get_zoho_access_token();
    $postData = [
        "data" => [[
            "Company" => "Bindutara User",
            "Last_Name" => explode(" ", $name)[1] ?? $name,
            "First_Name" => explode(" ", $name)[0],
            "Email" => $email,
            "Phone" => $mobile,
            "Lead_Source" => "Website Signup",
            "Description" => "User registered",
            "Custom_Password_Field" => $hashed_password
        ]]
    ];

    $ch = curl_init('https://www.zohoapis.in/crm/v2/Leads');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Zoho-oauthtoken $token",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

function get_zoho_access_token() {
    $refresh_token = ZOHO_REFRESH_TOKEN;
    $client_id = ZOHO_CLIENT_ID;
    $client_secret = ZOHO_CLIENT_SECRET;

    $url = "https://accounts.zoho.in/oauth/v2/token?refresh_token=$refresh_token&client_id=$client_id&client_secret=$client_secret&grant_type=refresh_token";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['access_token'];
}
?>
