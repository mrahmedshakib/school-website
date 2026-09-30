<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Admission Payment Submitted</title>
</head>

<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, sans-serif;">

<div style="max-width:650px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

    <div style="background:#4f46e5; color:#ffffff; padding:30px; text-align:center;">
        <h1 style="margin:0;">Payment Submitted</h1>

        <p style="margin:8px 0 0;">
            Admission Payment Information Received
        </p>
    </div>

    <div style="padding:35px;">

        <h2 style="color:#111827;">
            Dear {{ $payment->application->father_name }},
        </h2>

        <p style="color:#4b5563; line-height:1.7;">
            আপনার admission payment information সফলভাবে
            গ্রহণ করা হয়েছে।
        </p>

        <div style="background:#f8fafc; padding:20px; border-radius:10px; margin:25px 0;">

            <p>
                <strong>Application No:</strong>
                {{ $payment->application->application_no }}
            </p>

            <p>
                <strong>Payment No:</strong>
                {{ $payment->payment_no }}
            </p>

            <p>
                <strong>Student:</strong>
                {{ $payment->application->student_name }}
            </p>

            <p>
                <strong>Payment Method:</strong>
                {{ strtoupper($payment->payment_method) }}
            </p>

            <p>
                <strong>Transaction ID:</strong>
                {{ $payment->transaction_id }}
            </p>

            <p>
                <strong>Amount:</strong>
                ৳{{ number_format($payment->amount, 2) }}
            </p>

            <p>
                <strong>Status:</strong>
                Pending Verification
            </p>

        </div>

        <p style="color:#4b5563; line-height:1.7;">
            Admin আপনার payment information যাচাই করার পর
            admission application confirm করা হবে।
        </p>

        <p style="color:#6b7280; font-size:14px;">
            এই email টি স্বয়ংক্রিয়ভাবে পাঠানো হয়েছে।
        </p>

    </div>

</div>

</body>
</html>