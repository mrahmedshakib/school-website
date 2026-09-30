<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Admission Application Submitted</title>
</head>

<body style="margin:0; padding:0; background:#f4f7fb; font-family:Arial, sans-serif;">

<div style="max-width:650px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden;">

    <div style="background:#4f46e5; color:#ffffff; padding:30px; text-align:center;">
        <h1 style="margin:0;">Online Admission</h1>
        <p style="margin:8px 0 0;">
            Application Submitted Successfully
        </p>
    </div>

    <div style="padding:35px;">

        <h2 style="color:#111827;">
            Dear {{ $application->father_name }},
        </h2>

        <p style="color:#4b5563; line-height:1.7;">
            আপনার সন্তানের Online Admission Application সফলভাবে
            জমা হয়েছে।
        </p>

        <div style="background:#f8fafc; padding:20px; border-radius:10px; margin:25px 0;">

            <p>
                <strong>Application No:</strong>
                {{ $application->application_no }}
            </p>

            <p>
                <strong>Student Name:</strong>
                {{ $application->student_name }}
            </p>

            <p>
                <strong>Class:</strong>
                {{ $application->class }}
            </p>

            <p>
                <strong>Status:</strong>
                Pending
            </p>

        </div>

        <p style="color:#4b5563; line-height:1.7;">
            অনুগ্রহ করে আপনার Application Number সংরক্ষণ করুন।
            Admission Fee payment করার সময় এই Application Number
            প্রয়োজন হবে।
        </p>

        <p style="color:#4b5563;">
            Admission Fee payment করার পর Transaction ID দিয়ে
            payment information submit করতে হবে।
        </p>

        <hr style="border:none; border-top:1px solid #e5e7eb; margin:30px 0;">

        <p style="color:#6b7280; font-size:14px;">
            এই email টি স্বয়ংক্রিয়ভাবে পাঠানো হয়েছে।
        </p>

    </div>

</div>

</body>
</html>