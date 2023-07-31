<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $photos = $_FILES['photos'];
    $product_details = $_POST['product_details'];
    $car_brand = $_POST['car_brand'];
    $car_model = $_POST['car_model'];
    $car_year = $_POST['car_year'];
    $product_code = $_POST['product_code'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $attachments = [];
    foreach ($photos['name'] as $index => $name) {
        $file_content = file_get_contents($photos['tmp_name'][$index]);
        $attachments[] = $file_content;
    }

    // Send the email
    $to = 'juancamargo43@gmail.com';
    $subject = 'Cotizacion';
    $message = '
        From: ' . $name . ' ' . $surname . '
        Email: ' . $email . '
        Phone Number: ' . $phone_number . '

        Product Details: ' . $product_details . '
        Car Brand: ' . $car_brand . '
        Car Model: ' . $car_model . '
        Car Year: ' . $car_year . '
        Product Code: ' . $product_code . '

        Photos:
        ' . implode(', ', $attachments) . '
    ';

    mail($to, $subject, $message, $attachments);

    // Redirect to the success page
    header('Location: success.html');
}
?>
