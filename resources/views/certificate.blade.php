<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
@include('nav')






    <!-- Certificate Curriculum Section -->
    <section id="certificate" class="py-5" style="background-color: #F2D2B8;">
        <div class="container">
            <h2 class="text-center w-100 fw-bold mb-5" style="color: #6c3428;">Syllabus of Pyinnyar Pankhin University for kids</h2>

            <!-- Course Description Card -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header" style="background-color: #6c3428; color: white;">
                    <h5 class="mb-0 text-light">Course Description</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Pyinnyar Pankhin University for Kids (PPUK) is established in late 2022 in Myanaung, Ayeyarwady Region, Burma. Actually this university is not freshly instituted, there has already had a center with about three hundred students, called "Pyinnyar Pankhin English Training Center (PPETC), founded in 2015, with purposes of sharing Language and academic skills with children and the center becomes the university. The university is still a part of the Center.<br><br>
Since its inception, Pyinnyar Pankhin English Training Center has offered on-campus and online classes to children with the help of local teachers and international volunteer teachers. When Covid-19 pandemic hit Burma, all In-Person classes were canceled but online classes have been continued until now. Pyinnyar Pankhin Center offer free SAT classes, GED classes, and 4 skill English Classes with the help of American tutors.<br><br>
The idea of next movement is Pyinnyar Pankhin would start University for Kids, getting more subject areas of studies included rather than just giving English classes. This program is designed to offer in-demand skills, knowledge, and experiences to students for success in classes and in life. Some courses should be online, and some should be on campus.<br><br>
1.1 Course system model/structure<br>
• Course credit assignment<br>
• Course period (start and end dates)<br>
• Open course classification<br>
• Tracking students' performance/students' evaluation (tests, tutorials, exams, evaluation, etc.)<br>
• Teamwork, collaboration, synergistic effort, etc.<br>
• ***Course requirement sheet (core courses + elective coursesà total 100 credits)<br>
• Course credits (pass or fail) [This will be instructors' decision.)<br>
o Pass à earn full credit of the course.<br>
o Retry à need to repeat the class.<br>
o Teachers will have to submit a letter of report form to explain why "retry" credit is decided.<br><br>
2. Why take this course?<br>
The courses of the University for Kids are introduction to academic knowledge and practical skills. These are designed to improve analytical skills, synthesizing skills, and self-evaluation. Rather than memorizing facts in the books, the courses will help students to examine how to write and what to write based on the facts they have searched. This makes the students improve their analytical skills.<br><br>
And then, students synthesize personal observations, team-work and personal experiences and critical thinking for an original writing. All these improvements lead to self-evaluation because students will revise their performance and others' performance and further thinking is how to improve with better understanding of weakness and strength of own writing and thinking. With the help of the above practice, students will have cognitive skills for their academic and real life.<br><br>
*The word "Kid" means 8 years to 22 years old students should be. If the age of a student lies outside of this prescribed range, it would be considered on a case-by-case basis.</p>
                </div>
            </div>

            <!-- Subjects and Sub-Subjects Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover data-table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Subject</th>
                                    <th>Learning Objective</th>
                                    <th>Accompanying assessments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subjects as $subject)
                                <tr>
                                    <td><strong>{{ $subject->name }}</strong></td>
                                    <td>
                                        @if($subject->subSubjects->count() > 0)
                                        <ul class="list-unstyled mb-0">
                                            @foreach($subject->subSubjects as $subSubject)
                                            <li>
                                                • {{ $subSubject->name }}
                                                @if($subSubject->status == 'active')
                                                    <i style="font-size: 7px;" class="fas fa-star text-danger" title="Active"></i>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <span class="text-muted">No sub-subjects available.</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subject->subSubjects->count() > 0)
                                        @foreach($subject->subSubjects as $subSubject)
                                        @if($subSubject->remark)
                                        <small>{{ $subSubject->remark }}</small><br>
                                        @endif
                                        @endforeach
                                        @else
                                        <span class="text-muted">No accompanying assessments available.</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No subjects available at the moment.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Art Participation Section -->
            <div class="card mt-4 mb-4 shadow-sm">
                <div class="card-header" style="background-color: #6c3428; color: white;">
                    <h5 class="mb-0 text-light">Art Participation</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Arts and music are a part of life. Participation in the art classes will be useful in academic and real life because both lives deal with huge stress. Arts and music like singing or playing can somehow release stress. What is more the art participation can help to lead armatures as well as professionals.<br><br>
The class should be in the evening after all classes are done. In Saturday morning, the performance of students from the arts and music classes should have one hour. What and how many classes will depend on how many teachers available are.<br><br>
<strong>Academic and language skills</strong><br>
Reading is mandatory for all students. Everyone is supposed to read proper 100 books at least with two-page summary of each book. Ten different writing assignments needed to be done. Fluency of English in presentations, active participation in class-discussion and argument about will be scored. Other languages, depending on teachers available will be scored as well.<br><br>
<strong>Social skills</strong><br>
All students need to join Teamwork, Social help, Community work/organizers, Debates & presentations and Leadership. Social skills are equally important for life as knowledge. This course enhances the quality of life by helping each other or learning from the argument.<br><br>
<strong>Arts & Music:</strong><br>
Art and music can release stress and depression. As relaxation, students are supposed to take one of subjects available in Art and Music. All arts subjects probably cannot be offered but depending on teachers available, art and music subjects can be taken. For example, taking pictures with proper lighting, correct composition, clear subject, a good angle, and fitting color is no need take courses. Students themselves learn online how to take a good picture. Other teacher available art subjects will be offered on campus.<br><br>
<strong>Housework & Crafts</strong><br>
The subjects of Housework and Crafts also depend very on teachers available. Depending on personal interest, students can learn the crafts by themselves.<br><br>
<strong>STEM (Science, Technology, Engineering and Mathematics)</strong><br>
STEMP will be taught on the campus. Individual and united performers are needed.<br><br>
<strong>Sport</strong><br>
Traditional games like pillow hitting, defending and catching game etc.<br>
Volleyball…<br>
Basketball. ...<br>
Badminton. ...<br>
Cricket. ...<br>
Tennis…<br><br>
<strong>Course Policies</strong><br>
● 0 = absent<br>
● 1 = present but not respectfully participating in class discussion or activities (e.g., dominating class discussion by distracting yourself and other students, not participating in class discussion, not even giving comments etc.)<br>
● 2 = present and respectfully participating in class discussion and small-group activities<br><br>
In-Class Participation</p>
                </div>
            </div>
        </div>
    </section>







@include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
