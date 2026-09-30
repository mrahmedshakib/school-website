<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Admission Confirmed</title>
</head>

<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, sans-serif;">

<div style="max-width:650px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

    <div style="background:#16a34a; color:#ffffff; padding:35px; text-align:center;">

        <div style="font-size:45px;">
            ✓
        </div>

        <h1 style="margin:10px 0 0;">
            Admission Confirmed
        </h1>

        <p style="margin:8px 0 0;">
            Payment Successfully Verified
        </p>

    </div>

    <div style="padding:35px;">

        <h2 style="color:#111827;">
            Dear {{ $payment->application->father_name }},
        </h2>

        <p style="color:#4b5563; line-height:1.7;">
            আপনার admission payment সফলভাবে verified হয়েছে।
            আপনার সন্তানের online admission application
            এখন confirmed হয়েছে।
        </p>

        <div style="background:#f0fdf4; padding:20px; border-radius:10px; margin:25px 0;">

            <p>
                <strong>Application No:</strong>
                {{ $payment->application->application_no }}
            </p>

            <p>
                <strong>Student Name:</strong>
                {{ $payment->application->student_name }}
            </p>

            <p>
                <strong>Class:</strong>
                {{ $payment->application->class }}
            </p>

            <p>
                <strong>Payment No:</strong>
                {{ $payment->payment_no }}
            </p>

            <p>
                <strong>Transaction ID:</strong>
                {{ $payment->transaction_id }}
            </p>

            <p>
                <strong>Paid Amount:</strong>
                ৳{{ number_format($payment->amount, 2) }}
            </p>

            <p>
                <strong>Status:</strong>
                Confirmed
            </p>

        </div>

        <p style="color:#4b5563; line-height:1.7;">
            অনুগ্রহ করে এই Application Number এবং Payment
            information ভবিষ্যতের জন্য সংরক্ষণ করুন।
        </p>

        <p style="color:#6b7280; font-size:14px;">
            এই email টি স্বয়ংক্রিয়ভাবে পাঠানো হয়েছে।
        </p>

    </div>

</div>

</body>
</html>