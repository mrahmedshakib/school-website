<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicSyllabus;
use App\Models\ClassRoutine;
use App\Models\ExamRoutine;
use App\Models\AcademicSubject;
use App\Models\ExamResult;
use App\Models\StudentMark;
use App\Models\Student;
use App\Models\SchoolPublication;
use App\Models\VideoGallery;

class AcademicAndContentModulesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Academic Syllabuses
        $syllabuses = [
            [
                'title_bn' => 'বার্ষিক পাঠ্যক্রম ও সিলেবাস ২০২৬ - ষষ্ঠ শ্রেণি',
                'title_en' => 'Annual Academic Syllabus 2026 - Class Six',
                'class' => '৬ষ্ঠ শ্রেণি (Class Six)',
                'academic_year' => '2026',
                'subject_name_bn' => 'সকল বিষয় (All Subjects)',
                'subject_name_en' => 'All Subjects',
                'description_bn' => 'জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB) প্রণীত নতুন কারিকুলাম অনুযায়ী প্রণীত সিলেবাস।',
                'description_en' => 'Curriculum aligned with the new NCTB educational guidelines and lesson plans.',
                'file_path' => 'uploads/syllabuses/syllabus_class_6.pdf',
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'title_bn' => 'বার্ষিক পাঠ্যক্রম ও সিলেবাস ২০২৬ - সপ্তম শ্রেণি',
                'title_en' => 'Annual Academic Syllabus 2026 - Class Seven',
                'class' => '৭ম শ্রেণি (Class Seven)',
                'academic_year' => '2026',
                'subject_name_bn' => 'সকল বিষয় (All Subjects)',
                'subject_name_en' => 'All Subjects',
                'description_bn' => 'সপ্তম শ্রেণির শিক্ষার্থীদের জন্য বার্ষিক মূল্যায়ন ও পাঠ্য পরিকল্পনা।',
                'description_en' => 'Annual evaluation syllabus and lesson plans for Class 7 students.',
                'file_path' => 'uploads/syllabuses/syllabus_class_7.pdf',
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'title_bn' => 'এসএসসি পরীক্ষার পূর্ণাঙ্গ সিলেবাস ২০২৬ - নবম ও দশম শ্রেণি',
                'title_en' => 'Comprehensive SSC Syllabus 2026 - Class Nine & Ten',
                'class' => '৯ম শ্রেণি (Class Nine)',
                'academic_year' => '2026',
                'subject_name_bn' => 'বিজ্ঞান, মানবিক ও ব্যবসায় শিক্ষা',
                'subject_name_en' => 'Science, Humanities & Business Studies',
                'description_bn' => 'মাধ্যমিক পরীক্ষার জন্য অধ্যায়ভিত্তিক বিস্তারিত পাঠ্যক্রম ও ব্যবহারিক পরীক্ষার সূচি।',
                'description_en' => 'Detailed chapter-wise syllabus and practical exam blueprint for secondary students.',
                'file_path' => 'uploads/syllabuses/syllabus_ssc_2026.pdf',
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'title_bn' => 'এইচএসসি পাঠ্যক্রম ও বিষয়ভিত্তিক সিলেবাস ২০২৬ - একাদশ শ্রেণি',
                'title_en' => 'HSC Academic Syllabus 2026 - Class Eleven',
                'class' => 'একাদশ শ্রেণি (Class Eleven)',
                'academic_year' => '2026',
                'subject_name_bn' => 'উচ্চ মাধ্যমিক সকল বিভাগ',
                'subject_name_en' => 'Higher Secondary All Groups',
                'description_bn' => 'উচ্চ মাধ্যমিক কলেজ শাখার বিজ্ঞান ও মানবিক বিভাগের পূর্ণাঙ্গ কোর্স সিলেবাস।',
                'description_en' => 'Complete higher secondary course syllabus for Science and Humanities disciplines.',
                'file_path' => 'uploads/syllabuses/syllabus_hsc_2026.pdf',
                'status' => 1,
                'sort_order' => 4,
            ],
        ];

        foreach ($syllabuses as $s) {
            AcademicSyllabus::updateOrCreate(['title_bn' => $s['title_bn']], $s);
        }

        // 2. Class Routines
        $classRoutines = [
            [
                'title_bn' => 'দৈনিক ক্লাস রুটিন ২০২৬ - প্রাথমিক শাখা (প্লে - ৫ম শ্রেণি)',
                'title_en' => 'Daily Class Routine 2026 - Primary Section (Play - Class 5)',
                'class' => 'প্রাথমিক শাখা (Primary Section)',
                'section' => 'A & B',
                'shift' => 'Morning (প্রভাতি)',
                'academic_year' => '2026',
                'file_path' => 'uploads/routines/primary_routine_2026.pdf',
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'title_bn' => 'দৈনিক ক্লাস সময়সূচি ২০২৬ - মাধ্যমিক শাখা (৬ষ্ঠ - ৮ম শ্রেণি)',
                'title_en' => 'Daily Class Schedule 2026 - Junior High Section (Class 6 - 8)',
                'class' => '৬ষ্ঠ - ৮ম শ্রেণি',
                'section' => 'A, B & C',
                'shift' => 'Day (দিবা)',
                'academic_year' => '2026',
                'file_path' => 'uploads/routines/junior_routine_2026.pdf',
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'title_bn' => 'ক্লাস রুটিন ২০২৬ - মাধ্যমিক ও এসএসএসি শাখা (৯ম - ১০ম শ্রেণি)',
                'title_en' => 'Class Routine 2026 - High School & SSC Section (Class 9 - 10)',
                'class' => '৯ম - ১০ম শ্রেণি',
                'section' => 'বিজ্ঞান ও মানবিক',
                'shift' => 'Day (দিবা)',
                'academic_year' => '2026',
                'file_path' => 'uploads/routines/ssc_routine_2026.pdf',
                'status' => 1,
                'sort_order' => 3,
            ],
            [
                'title_bn' => 'কলেজ শাখা ক্লাস রুটিন ২০২৬ - একাদশ ও দ্বাদশ শ্রেণি',
                'title_en' => 'College Section Class Routine 2026 - Class 11 & 12',
                'class' => 'একাদশ ও দ্বাদশ শ্রেণি (College)',
                'section' => 'Science & Humanities',
                'shift' => 'Day (দিবা)',
                'academic_year' => '2026',
                'file_path' => 'uploads/routines/college_routine_2026.pdf',
                'status' => 1,
                'sort_order' => 4,
            ],
        ];

        foreach ($classRoutines as $cr) {
            ClassRoutine::updateOrCreate(['title_bn' => $cr['title_bn']], $cr);
        }

        // 3. Exam Routines
        $examRoutines = [
            [
                'title_bn' => 'অর্ধ-বার্ষিক মূল্যায়ন ও পরীক্ষা সময়সূচি ২০২৬',
                'title_en' => 'Half-Yearly Evaluation & Examination Schedule 2026',
                'exam_name_bn' => 'অর্ধ-বার্ষিক পরীক্ষা',
                'exam_name_en' => 'Half-Yearly Exam',
                'class' => '৬ষ্ঠ থেকে ১০ম শ্রেণি',
                'academic_year' => '2026',
                'start_date' => '2026-06-10',
                'end_date' => '2026-06-25',
                'file_path' => 'uploads/routines/half_yearly_exam_2026.pdf',
                'status' => 1,
                'sort_order' => 1,
            ],
            [
                'title_bn' => 'বার্ষিক পরীক্ষা ও চূড়ান্ত মূল্যায়ন সময়সূচি ২০২৬',
                'title_en' => 'Annual Examination & Final Assessment Schedule 2026',
                'exam_name_bn' => 'বার্ষিক পরীক্ষা',
                'exam_name_en' => 'Annual Examination',
                'class' => 'প্লে থেকে ৯ম শ্রেণি',
                'academic_year' => '2026',
                'start_date' => '2026-11-15',
                'end_date' => '2026-11-30',
                'file_path' => 'uploads/routines/annual_exam_2026.pdf',
                'status' => 1,
                'sort_order' => 2,
            ],
            [
                'title_bn' => 'এসএসসি প্রি-টেস্ট ও টেস্ট নির্বাচনী পরীক্ষা সময়সূচি ২০২৬',
                'title_en' => 'SSC Pre-Test & Test Selection Examination Schedule 2026',
                'exam_name_bn' => 'এসএসসি নির্বাচনী পরীক্ষা',
                'exam_name_en' => 'SSC Test Exam',
                'class' => '১০ম শ্রেণি (SSC Candidates)',
                'academic_year' => '2026',
                'start_date' => '2026-10-05',
                'end_date' => '2026-10-22',
                'file_path' => 'uploads/routines/ssc_test_exam_2026.pdf',
                'status' => 1,
                'sort_order' => 3,
            ],
        ];

        foreach ($examRoutines as $er) {
            ExamRoutine::updateOrCreate(['title_bn' => $er['title_bn']], $er);
        }

        // 4. Academic Subjects
        $subjects = [
            [
                'name_bn' => 'বাংলা ১ম ও ২য় পত্র',
                'name_en' => 'Bangla 1st & 2nd Paper',
                'code' => '101-102',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'General (সকল বিভাগ)',
                'type' => 'Compulsory',
                'total_marks' => 200,
                'theory_marks' => 200,
                'practical_marks' => 0,
                'viva_marks' => 0,
                'description_bn' => 'সাহিত্য, ব্যাকরণ ও নির্মিতি পাঠ্যক্রম।',
                'description_en' => 'Bengali literature, grammar and creative composition curriculum.',
            ],
            [
                'name_bn' => 'ইংরেজি ১ম ও ২য় পত্র',
                'name_en' => 'English 1st & 2nd Paper',
                'code' => '107-108',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'General (সকল বিভাগ)',
                'type' => 'Compulsory',
                'total_marks' => 200,
                'theory_marks' => 200,
                'practical_marks' => 0,
                'viva_marks' => 0,
                'description_bn' => 'কমিউনিকেটিভ ইংলিশ, রিডিং স্কিল ও গ্রামার।',
                'description_en' => 'Communicative English, reading comprehension, writing & grammar.',
            ],
            [
                'name_bn' => 'সাধারণ গণিত',
                'name_en' => 'General Mathematics',
                'code' => '109',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'General (সকল বিভাগ)',
                'type' => 'Compulsory',
                'total_marks' => 100,
                'theory_marks' => 100,
                'practical_marks' => 0,
                'viva_marks' => 0,
                'description_bn' => 'পাটিগণিত, বীজগণিত, জ্যামিতি, ত্রিকোণমিতি ও পরিসংখ্যান।',
                'description_en' => 'Arithmetic, algebra, geometry, trigonometry and statistics.',
            ],
            [
                'name_bn' => 'তথ্য ও যোগাযোগ প্রযুক্তি (ICT)',
                'name_en' => 'Information & Communication Technology',
                'code' => '154',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'General (সকল বিভাগ)',
                'type' => 'Compulsory',
                'total_marks' => 50,
                'theory_marks' => 25,
                'practical_marks' => 25,
                'viva_marks' => 0,
                'description_bn' => 'কম্পিউটার হার্ডওয়্যার, সফটওয়্যার, নেটওয়ার্ক ও প্রোগ্রামিং পরিচিতি।',
                'description_en' => 'Computer literacy, digital devices, internet safety and introductory programming.',
            ],
            [
                'name_bn' => 'পদার্থবিজ্ঞান',
                'name_en' => 'Physics',
                'code' => '136',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'Science (বিজ্ঞান)',
                'type' => 'Compulsory',
                'total_marks' => 100,
                'theory_marks' => 75,
                'practical_marks' => 25,
                'viva_marks' => 0,
                'description_bn' => 'গতি, বল, শক্তি, শব্দ, আলো ও আধুনিক পদার্থবিজ্ঞান।',
                'description_en' => 'Motion, force, energy, optics, electricity and modern physics with lab work.',
            ],
            [
                'name_bn' => 'রসায়ন',
                'name_en' => 'Chemistry',
                'code' => '137',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'Science (বিজ্ঞান)',
                'type' => 'Compulsory',
                'total_marks' => 100,
                'theory_marks' => 75,
                'practical_marks' => 25,
                'viva_marks' => 0,
                'description_bn' => 'পরমাণুর গঠন, রাসায়নিক বন্ধন, পর্যায় সারণি ও এসিড-ক্ষারক।',
                'description_en' => 'Atomic structure, periodic table, chemical bonding and reactions with laboratory practice.',
            ],
            [
                'name_bn' => 'জীববিজ্ঞান',
                'name_en' => 'Biology',
                'code' => '138',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'Science (বিজ্ঞান)',
                'type' => 'Compulsory',
                'total_marks' => 100,
                'theory_marks' => 75,
                'practical_marks' => 25,
                'viva_marks' => 0,
                'description_bn' => 'কোষ ও টিস্যু, উদ্ভিদ ও প্রাণীর অঙ্গসংস্থান, বংশগতি ও পরিবেশ।',
                'description_en' => 'Cell biology, physiology, genetics, ecology and biodiversity.',
            ],
            [
                'name_bn' => 'উচ্চতর গণিত',
                'name_en' => 'Higher Mathematics',
                'code' => '126',
                'class' => '৯ম - ১০ম শ্রেণি',
                'group_name' => 'Science (বিজ্ঞান)',
                'type' => 'Optional',
                'total_marks' => 100,
                'theory_marks' => 75,
                'practical_marks' => 25,
                'viva_marks' => 0,
                'description_bn' => 'ফাংশন, বীজগণিতীয় রাশি, জ্যামিতিক অঙ্কন, স্থানাঙ্ক জ্যামিতি ও সম্ভাবনা।',
                'description_en' => 'Advanced algebra, functions, coordinate geometry, calculus fundamentals and probability.',
            ],
        ];

        foreach ($subjects as $sb) {
            AcademicSubject::updateOrCreate(['code' => $sb['code'], 'class' => $sb['class']], $sb);
        }

        // 5. Exam Results (Gazettes / Circulars)
        $examResults = [
            [
                'title_bn' => 'এসএসসি পরীক্ষার ফলাফল ২০২৫ - শতভাগ সাফল্য',
                'title_en' => 'SSC Examination Results 2025 - 100% Pass Rate',
                'exam_name_bn' => 'এসএসসি পরীক্ষা ২০২৫',
                'exam_name_en' => 'SSC Examination 2025',
                'class' => '১০ম শ্রেণি (SSC)',
                'academic_year' => '2025',
                'publish_date' => '2025-05-12',
                'file_path' => 'uploads/results/ssc_result_2025.pdf',
                'total_students' => 142,
                'passed_students' => 142,
                'failed_students' => 0,
                'gpa5_count' => 118,
                'pass_rate' => 100.00,
            ],
            [
                'title_bn' => 'এইচএসসি পরীক্ষার ফলাফল ২০২৪ - বিয়াম কলেজ শাখা',
                'title_en' => 'HSC Examination Results 2024 - BIAM College Section',
                'exam_name_bn' => 'এইচএসসি পরীক্ষা ২০২৪',
                'exam_name_en' => 'HSC Examination 2024',
                'class' => 'দ্বাদশ শ্রেণি (HSC)',
                'academic_year' => '2024',
                'publish_date' => '2024-10-15',
                'file_path' => 'uploads/results/hsc_result_2024.pdf',
                'total_students' => 98,
                'passed_students' => 97,
                'failed_students' => 1,
                'gpa5_count' => 64,
                'pass_rate' => 98.98,
            ],
            [
                'title_bn' => 'বার্ষিক পরীক্ষা ফলাফল ২০২৫ - মাধ্যমিক শাখা (৬ষ্ঠ-৯ম শ্রেণি)',
                'title_en' => 'Annual Examination Result Gazette 2025 - Secondary Section',
                'exam_name_bn' => 'বার্ষিক পরীক্ষা ২০২৫',
                'exam_name_en' => 'Annual Exam 2025',
                'class' => '৬ষ্ঠ - ৯ম শ্রেণি',
                'academic_year' => '2025',
                'publish_date' => '2025-12-28',
                'file_path' => 'uploads/results/annual_gazette_2025.pdf',
                'total_students' => 380,
                'passed_students' => 376,
                'failed_students' => 4,
                'gpa5_count' => 245,
                'pass_rate' => 98.95,
            ],
        ];

        foreach ($examResults as $res) {
            ExamResult::updateOrCreate(['title_bn' => $res['title_bn']], $res);
        }

        // 6. Individual Student Searchable Results
        $studentMarks = [
            [
                'exam_name_bn' => 'বার্ষিক পরীক্ষা ২০২৫',
                'exam_name_en' => 'Annual Examination 2025',
                'academic_year' => '2025',
                'class' => 'Class 9',
                'section' => 'A',
                'roll_no' => '101',
                'student_id' => 'BLSC-2025-0101',
                'student_name_bn' => 'তানভীর হাসান',
                'student_name_en' => 'Tanvir Hasan',
                'gpa' => 5.00,
                'grade' => 'A+',
                'total_marks' => 742,
                'result_status' => 'PASSED',
                'marks_details' => [
                    ['subject_bn' => 'বাংলা ১ম ও ২য় পত্র', 'subject_en' => 'Bangla', 'marks' => 172, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'ইংরেজি ১ম ও ২য় পত্র', 'subject_en' => 'English', 'marks' => 165, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'সাধারণ গণিত', 'subject_en' => 'General Mathematics', 'marks' => 94, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'পদার্থবিজ্ঞান', 'subject_en' => 'Physics', 'marks' => 88, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'রসায়ন', 'subject_en' => 'Chemistry', 'marks' => 91, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'জীববিজ্ঞান', 'subject_en' => 'Biology', 'marks' => 85, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'তথ্য ও যোগাযোগ প্রযুক্তি', 'subject_en' => 'ICT', 'marks' => 47, 'grade' => 'A+', 'point' => 5.0],
                ],
                'remarks' => 'Outstanding Performance. First in Class.',
            ],
            [
                'exam_name_bn' => 'বার্ষিক পরীক্ষা ২০২৫',
                'exam_name_en' => 'Annual Examination 2025',
                'academic_year' => '2025',
                'class' => 'Class 9',
                'section' => 'A',
                'roll_no' => '102',
                'student_id' => 'BLSC-2025-0102',
                'student_name_bn' => 'মারিয়া সুলতানা',
                'student_name_en' => 'Maria Sultana',
                'gpa' => 4.88,
                'grade' => 'A',
                'total_marks' => 705,
                'result_status' => 'PASSED',
                'marks_details' => [
                    ['subject_bn' => 'বাংলা ১ম ও ২য় পত্র', 'subject_en' => 'Bangla', 'marks' => 162, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'ইংরেজি ১ম ও ২য় পত্র', 'subject_en' => 'English', 'marks' => 155, 'grade' => 'A', 'point' => 4.0],
                    ['subject_bn' => 'সাধারণ গণিত', 'subject_en' => 'General Mathematics', 'marks' => 89, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'পদার্থবিজ্ঞান', 'subject_en' => 'Physics', 'marks' => 82, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'রসায়ন', 'subject_en' => 'Chemistry', 'marks' => 87, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'জীববিজ্ঞান', 'subject_en' => 'Biology', 'marks' => 86, 'grade' => 'A+', 'point' => 5.0],
                    ['subject_bn' => 'তথ্য ও যোগাযোগ প্রযুক্তি', 'subject_en' => 'ICT', 'marks' => 44, 'grade' => 'A+', 'point' => 5.0],
                ],
                'remarks' => 'Very Good Result. Keep it up.',
            ],
        ];

        foreach ($studentMarks as $sm) {
            StudentMark::updateOrCreate(
                ['exam_name_bn' => $sm['exam_name_bn'], 'class' => $sm['class'], 'roll_no' => $sm['roll_no']],
                $sm
            );
        }

        // 7. Enrolled Students
        $studentsList = [
            ['student_id' => 'BLSC-26-601', 'name_bn' => 'নাফিসা আক্তার', 'name_en' => 'Nafisa Akter', 'class' => 'Class 6', 'section' => 'A', 'roll_no' => '1', 'gender' => 'female', 'academic_year' => '2026', 'guardian_name_bn' => 'মোঃ জহিরুল ইসলাম', 'guardian_name_en' => 'Md. Jahirul Islam', 'guardian_phone' => '01711223344', 'blood_group' => 'A+'],
            ['student_id' => 'BLSC-26-602', 'name_bn' => 'সাদমান সাকিব', 'name_en' => 'Sadman Sakib', 'class' => 'Class 6', 'section' => 'A', 'roll_no' => '2', 'gender' => 'male', 'academic_year' => '2026', 'guardian_name_bn' => 'মোঃ মোজাম্মেল হক', 'guardian_name_en' => 'Md. Mozammel Haque', 'guardian_phone' => '01722334455', 'blood_group' => 'B+'],
            ['student_id' => 'BLSC-26-701', 'name_bn' => 'ফারিহা জাহান', 'name_en' => 'Fariha Jahan', 'class' => 'Class 7', 'section' => 'A', 'roll_no' => '1', 'gender' => 'female', 'academic_year' => '2026', 'guardian_name_bn' => 'আনোয়ার হোসেন', 'guardian_name_en' => 'Anwar Hossain', 'guardian_phone' => '01733445566', 'blood_group' => 'O+'],
            ['student_id' => 'BLSC-26-801', 'name_bn' => 'আবির মাহমুদ', 'name_en' => 'Abir Mahmud', 'class' => 'Class 8', 'section' => 'A', 'roll_no' => '1', 'gender' => 'male', 'academic_year' => '2026', 'guardian_name_bn' => 'মাহমুদুল হাসান', 'guardian_name_en' => 'Mahmudul Hasan', 'guardian_phone' => '01744556677', 'blood_group' => 'AB+'],
            ['student_id' => 'BLSC-26-901', 'name_bn' => 'তানভীর হাসান', 'name_en' => 'Tanvir Hasan', 'class' => 'Class 9', 'section' => 'A', 'roll_no' => '1', 'gender' => 'male', 'academic_year' => '2026', 'guardian_name_bn' => 'মোস্তাফিজুর রহমান', 'guardian_name_en' => 'Mostafizur Rahman', 'guardian_phone' => '01755667788', 'blood_group' => 'A+'],
            ['student_id' => 'BLSC-26-902', 'name_bn' => 'মারিয়া সুলতানা', 'name_en' => 'Maria Sultana', 'class' => 'Class 9', 'section' => 'A', 'roll_no' => '2', 'gender' => 'female', 'academic_year' => '2026', 'guardian_name_bn' => 'আবুল কালাম আজাদ', 'guardian_name_en' => 'Abul Kalam Azad', 'guardian_phone' => '01766778899', 'blood_group' => 'O+'],
        ];

        foreach ($studentsList as $stu) {
            Student::updateOrCreate(['student_id' => $stu['student_id']], $stu);
        }

        // 8. Magazines & Publications
        $publications = [
            [
                'type' => 'magazine',
                'title_bn' => 'বার্ষিকী স্কুল ম্যাগাজিন "প্রভাতি" - ২০২৫',
                'title_en' => 'Annual School Magazine "Provati" - 2025',
                'edition_bn' => '১০ম প্রকাশনা',
                'edition_en' => '10th Edition',
                'publish_date' => '2025-02-21',
                'academic_year' => '2025',
                'description_bn' => 'শিক্ষার্থীদের রচিত গল্প, কবিতা, প্রবন্ধ, চিত্রাঙ্কন ও বিদ্যালয়ের বার্ষিক কার্যক্রমের স্মারক সংকলন।',
                'description_en' => 'Commemorative compilation of stories, poems, essays, artwork by students, and annual school activities.',
                'cover_image' => 'uploads/publications/magazine_2025_cover.jpg',
                'file_path' => 'uploads/publications/magazine_2025.pdf',
            ],
            [
                'type' => 'publication',
                'title_bn' => 'বার্ষিক তথ্য বিবরণী ও প্রাতিষ্ঠানিক প্রসপেক্টাস ২০২৬',
                'title_en' => 'Annual Information Brochure & Institutional Prospectus 2026',
                'edition_bn' => 'ভর্তি সংস্করণ',
                'edition_en' => 'Admission Edition',
                'publish_date' => '2025-11-01',
                'academic_year' => '2026',
                'description_bn' => 'বিদ্যালয়ের পরিচিতি, শিক্ষকবৃন্দ, একাডেমিক নীতিমালা, সহশিক্ষা কার্যক্রম ও ভর্তি সংক্রান্ত পূর্ণাঙ্গ বিবরণী।',
                'description_en' => 'Comprehensive information on school profile, faculty, academic regulations, co-curriculars & admissions.',
                'cover_image' => 'uploads/publications/prospectus_2026_cover.jpg',
                'file_path' => 'uploads/publications/prospectus_2026.pdf',
            ],
            [
                'type' => 'magazine',
                'title_bn' => 'বিজ্ঞান সাময়িকী ও দেয়ালিকা স্মারক ২০২৪',
                'title_en' => 'Science Journal & Wall Magazine Souvenir 2024',
                'edition_bn' => 'বিশেষ বিজ্ঞান মেলা সংখ্যা',
                'edition_en' => 'Special Science Fair Edition',
                'publish_date' => '2024-03-26',
                'academic_year' => '2024',
                'description_bn' => 'আন্তঃবিদ্যালয় বিজ্ঞান ও তথ্যপ্রযুক্তি মেলার উদ্ভাবনী প্রজেক্টসমূহের ওপর বিশেষ সংকলন।',
                'description_en' => 'Special feature compilation on innovative science & IT projects presented at the inter-school science fair.',
                'cover_image' => 'uploads/publications/science_mag_cover.jpg',
                'file_path' => 'uploads/publications/science_mag_2024.pdf',
            ],
        ];

        foreach ($publications as $pub) {
            SchoolPublication::updateOrCreate(['title_bn' => $pub['title_bn']], $pub);
        }

        // 9. Video Gallery
        $videos = [
            [
                'title_bn' => 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ ক্যাম্পাস পরিচিতি ও তথ্যচিত্র',
                'title_en' => 'BIAM Laboratory School & College Campus Tour & Documentary',
                'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_id' => 'dQw4w9WgXcQ',
                'category_bn' => 'ক্যাম্পাস পরিচিতি',
                'category_en' => 'Campus Tour',
                'description_bn' => 'আমাদের মনোরম সবুজ ক্যাম্পাস, আধুনিক বিজ্ঞানাগার, কম্পিউটার ল্যাব ও সুপরিসর খেলার মাঠের দৃশ্য।',
                'description_en' => 'Overview of our green campus, modern laboratories, multimedia classrooms, and sports facilities.',
            ],
            [
                'title_bn' => 'বার্ষিক ক্রীড়া প্রতিযোগিতা ও বর্ণাঢ্য সাংস্কৃতিক অনুষ্ঠান ২০২৫',
                'title_en' => 'Annual Sports Meet & Colorful Cultural Celebration 2025',
                'youtube_url' => 'https://www.youtube.com/watch?v=L_LUpnjgPso',
                'video_id' => 'L_LUpnjgPso',
                'category_bn' => 'ক্রীড়া ও সংস্কৃতি',
                'category_en' => 'Sports & Culture',
                'description_bn' => 'শিক্ষার্থীদের মনোজ্ঞ কুচকাওয়াজ, আকর্ষণীয় ক্রীড়া প্রতিযোগিতা ও বর্ণিল ডিসপ্লে পরিবেশনা।',
                'description_en' => 'Mesmerizing parade, dynamic track & field events, and synchronized musical display by our students.',
            ],
            [
                'title_bn' => 'আন্তঃবিদ্যালয় বিজ্ঞান মেলা ও রোবোটিক্স প্রদর্শনী',
                'title_en' => 'Inter-School Science Fair & Robotics Exhibition',
                'youtube_url' => 'https://www.youtube.com/watch?v=jNQXAC9IVRw',
                'video_id' => 'jNQXAC9IVRw',
                'category_bn' => 'বিজ্ঞান মেলা',
                'category_en' => 'Science Fair',
                'description_bn' => 'কিশোর বিজ্ঞানীদের অভিনব আবিষ্কার ও স্মার্ট বাংলাদেশ থিমের রোবোটিক্স মডেল প্রদর্শনী।',
                'description_en' => 'Inspiring innovations, smart city prototypes, and interactive robotics displays by young scientists.',
            ],
            [
                'title_bn' => 'আন্তর্জাতিক মাতৃভাষা দিবস ও শহীদ দিবসের প্রভাতফেরি',
                'title_en' => 'International Mother Language Day & Morning Procession (Probhatferi)',
                'youtube_url' => 'https://www.youtube.com/watch?v=kJQP7kiw5Fk',
                'video_id' => 'kJQP7kiw5Fk',
                'category_bn' => 'জাতীয় দিবস',
                'category_en' => 'National Days',
                'description_bn' => 'অমর একুশের প্রথম প্রহরে শহীদ মিনারে পুষ্পস্তবক অর্পণ ও শ্রদ্ধার্ঘ্য নিবেদন।',
                'description_en' => 'Paying floral tributes at the Shaheed Minar and paying homage to language martyrs.',
            ],
        ];

        foreach ($videos as $v) {
            VideoGallery::updateOrCreate(['youtube_url' => $v['youtube_url']], $v);
        }
    }
}
