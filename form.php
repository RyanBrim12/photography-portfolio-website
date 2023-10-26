<?php 
include 'top.php';

$dataIsGood = false;

$firstName = '';
$lastName = '';
$email = '';
$subject = '';
$emailMessage = '';
$discoveryMethod = '';

function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data  = htmlspecialchars($data);
    }
    return $data;
}

function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}
?>
<main class="form">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $firstName = getData('txtFirstName');
        $lastName = getData('txtLastName');
        $email = getData('txtEmail');
        $subject = getData('txtSubject');
        $emailMessage = getData('txtMessage');
        $discoveryMethod = getData('radDiscoveryMethod');

        $dataIsGood = true;

        if ($firstName == '') {
            print '<p class="mistake">Please enter your first name.</p>';
            $dataIsGood = false;
        } elseif (!verifyAlphaNum($firstName)) {
            print '<p class="mistake">Your first name contains invalid characters.</p>';
            $dataIsGood = false;
        }

        if ($lastName == '') {
            print '<p class="mistake">Please enter your last name.</p>';
            $dataIsGood = false;
        } elseif (!verifyAlphaNum($lastName)) {
            print '<p class="mistake">Your last name contains invalid characters.</p>';
            $dataIsGood = false;
        }

        if ($email == '') {
            print '<p class="mistake">Please enter your email address.</p>';
            $dataIsGood = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            print '<p class="mistake">Your email address contains invalid characters.</p>';
            $dataIsGood = false;
        }

        if ($subject == '') {
            print '<p class="mistake">Please enter a subject.</p>';
            $dataIsGood = false;
        } elseif (!verifyAlphaNum($subject)) {
            print '<p class="mistake">Your subject contains invalid characters.</p>';
            $dataIsGood = false;
        }

        if ($emailMessage == '') {
            print '<p class="mistake">Please enter a message.</p>';
            $dataIsGood = false;
        }

        if ($discoveryMethod != "google" AND $discoveryMethod != "instagram" AND $discoveryMethod != "other") {
            print '<p class="mistake">Please select how you discovered me.</p>';
            $dataIsGood = false;
        }

        if ($dataIsGood) {
            try {
                $sql = 'INSERT INTO tblUserMessages ';
                $sql .= '(fldFirstName, fldLastName, fldEmail, fldSubject, fldMessage, fldDiscoveryMethod) ';
                $sql .= 'VALUES (?, ?, ?, ?, ?, ?)';
                $statement = $pdo->prepare($sql);
                $data = array($firstName, $lastName, $email, $subject, $emailMessage, $discoveryMethod);

                if ($statement->execute($data)) {
                    $message .= '<p class="success">Your information was successfully saved.</p>';

                    $to = $email;
                    $from = 'Ryan Brim <rbrim@uvm.edu>';
                    $mailMessageSubject = 'Ryan Brim CS 008 Final Project';

                    $mailMessage = '<p>Thank you for your message. Here is a copy.</p>';
                    $mailMessage .= '<section style="background-color: lightgreen; border: solid medium black; border-radius: 1em; padding: 2em; padding-top: .5em;">';
                    $mailMessage .= '<h1 style="text-align: center; ">Message</h1>';
                    $mailMessage .= '<p>Name: ' . $firstName . ' ' . $lastName . '</p>';
                    $mailMessage .= '<p>Subject: ' . $subject . '</p>';
                    $mailMessage .= '<p>Message:<br>' . $emailMessage . '</p></section>';
                    $mailMessage .= '<p>Ryan Brim Photography</p>';
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=utf-8\r\n";
                    $headers .= "From " . $from . "\r\n";
                    $mailSent = mail($to, $mailMessageSubject, $mailMessage, $headers);

                    if ($mailSent) {
                        print '<p class="success">A copy has been emailed to you for your records.</p>';
                    }
                } else {
                    $message = '<p class="mistake">Record was NOT successfully saved.</p>';
                    $dataIsGood = false;
                }
            } catch(PDOException $e) {
                $message = '<p class="mistake">Couldn\'t insert the record, please contact someone</p>';
            }
        }
    }
    print $message; ?>
    <section>
        <h2>Contact Me</h2>
        <form action="#" method="POST">
            <fieldset class="name">
                <p class="name first">
                    <label for="txtFirstName">First Name</label>
                    <input type="text" name="txtFirstName" id="txtFirstName" value="<?php print $firstName; ?>" maxlength="40" required>
                </p>
                <p class="name">
                    <label for="txtLastName">Last Name</label>
                    <input type="text" name="txtLastName" id="txtLastName" value="<?php print $lastName; ?>" maxlength="40" required>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <label for="txtEmail">Email Address</label>
                    <input type="email" name="txtEmail" id="txtEmail" maxlength="256" value="<?php print $email; ?>" required>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <label for="txtSubject">Subject</label>
                    <input type="text" name="txtSubject" id="txtSubject" value="<?php print $subject; ?>" maxlength="40" required>
                </p>
            </fieldset>
            <fieldset>
                <p>
                    <label for="txtMessage">Message</label>
                    <textarea name="txtMessage" id="txtMessage" cols="30" rows="10" maxlength="1000" required><?php print $emailMessage; ?></textarea>
                </p>
            </fieldset>
            <fieldset class="discovery">
                <legend>How did you find me?</legend>
                <p class="discovery">
                    <input type="radio" name="radDiscoveryMethod" value="google" id="radDiscoveryMethodGoogle" required <?php if ($discoveryMethod == 'google') print 'checked';?>>
                    <label for="radDiscoveryMethodGoogle">Google</label>
                </p>
                <p class="discovery">
                    <input type="radio" name="radDiscoveryMethod" value="instagram" id="radDiscoveryMethodInstagram" required <?php if ($discoveryMethod == 'instagram') print 'checked';?>>
                    <label for="radDiscoveryMethodInstagram">Instagram</label>
                </p>
                <p class="discovery">
                    <input type="radio" name="radDiscoveryMethod" value="other" id="radDiscoveryMethodOther" required <?php if ($discoveryMethod == 'other') print 'checked';?>>
                    <label for="radDiscoveryMethodOther">Other</label>
                </p>
            </fieldset>
            <fieldset>
                <p class="submit">
                    <input type="submit" name="btnSubmit">
                </p>
            </fieldset>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>