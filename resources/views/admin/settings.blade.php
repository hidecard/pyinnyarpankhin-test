@extends('admin.layout')

@section('title', 'System Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="settings-container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 style="color: #6C3428;"><i class="fas fa-cogs me-2"></i>System Settings</h2>
                    <div>
                        <button type="button" class="btn btn-warning me-2" onclick="resetSettings()">
                            <i class="fas fa-undo me-1"></i>Reset to Default
                        </button>
                        <button type="button" class="btn btn-success" onclick="saveAllSettings()">
                            <i class="fas fa-save me-1"></i>Save All Changes
                        </button>
                    </div>
                </div>

                <div class="settings-tabs">
                    <button class="tab-btn active mb-3" data-tab="general" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-university me-2"></i>General
                    </button>
                    <button class="tab-btn" data-tab="academic" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-graduation-cap me-2"></i>Academic
                    </button>
                    <button class="tab-btn" data-tab="student" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-user-graduate me-2"></i>Students
                    </button>
                    <button class="tab-btn" data-tab="faculty" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Faculty
                    </button>
                    <button class="tab-btn" data-tab="finance" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-money-bill-wave me-2"></i>Finance
                    </button>
                    <button class="tab-btn" data-tab="system" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-desktop me-2"></i>System
                    </button>
                    <button class="tab-btn" data-tab="security" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                        <i class="fas fa-shield-alt me-2"></i>Security
                    </button>
                </div>

                <div class="settings-content">
                    <!-- General Settings -->
                    <div class="tab-pane active mt-3" id="general">
                        <h3 style="color: #6C3428;"><i class="fas fa-university me-2"></i>General Settings</h3>
                        <form id="general-form" method="POST" action="{{ route('admin.settings.update', 'general') }}">
                            @csrf
                            <input type="hidden" name="group" value="general">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">University Name</label>
                                    <input type="text" name="settings[university_name][value]" class="form-control" value="{{ $settings['general']->where('key', 'university_name')->first()?->value ?? 'Pyinnyar Pankhin University' }}">
                                    <input type="hidden" name="settings[university_name][key]" value="university_name">
                                    <input type="hidden" name="settings[university_name][type]" value="string">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">University Address</label>
                                    <input type="text" name="settings[university_address][value]" class="form-control" value="{{ $settings['general']->where('key', 'university_address')->first()?->value ?? 'Myanaung, Ayeyarwaddy Myanmar' }}">
                                    <input type="hidden" name="settings[university_address][key]" value="university_address">
                                    <input type="hidden" name="settings[university_address][type]" value="string">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" style="color: #6C3428;">Phone Number</label>
                                    <input type="text" name="settings[university_phone][value]" class="form-control" value="{{ $settings['general']->where('key', 'university_phone')->first()?->value ?? '(09) 456789101' }}">
                                    <input type="hidden" name="settings[university_phone][key]" value="university_phone">
                                    <input type="hidden" name="settings[university_phone][type]" value="string">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" style="color: #6C3428;">Email Address</label>
                                    <input type="email" name="settings[university_email][value]" class="form-control" value="{{ $settings['general']->where('key', 'university_email')->first()?->value ?? 'pininyarpankhin@gmail.com' }}">
                                    <input type="hidden" name="settings[university_email][key]" value="university_email">
                                    <input type="hidden" name="settings[university_email][type]" value="string">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" style="color: #6C3428;">Website</label>
                                    <input type="url" name="settings[university_website][value]" class="form-control" value="{{ $settings['general']->where('key', 'university_website')->first()?->value ?? 'https://pyinnyarpankhin.edu.mm' }}">
                                    <input type="hidden" name="settings[university_website][key]" value="university_website">
                                    <input type="hidden" name="settings[university_website][type]" value="string">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save General Settings
                            </button>
                        </form>
                    </div>

                    <!-- Academic Settings -->
                    <div class="tab-pane mt-3" id="academic">
                        <h3 style="color: #6C3428;"><i class="fas fa-graduation-cap me-2"></i>Academic Settings</h3>
                        <form id="academic-form" method="POST" action="{{ route('admin.settings.update', 'academic') }}">
                            @csrf
                            <input type="hidden" name="group" value="academic">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Academic Year Start</label>
                                    <input type="date" name="settings[academic_year_start][value]" class="form-control" value="{{ $settings['academic']->where('key', 'academic_year_start')->first()?->value ?? '2024-06-01' }}">
                                    <input type="hidden" name="settings[academic_year_start][key]" value="academic_year_start">
                                    <input type="hidden" name="settings[academic_year_start][type]" value="string">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Academic Year End</label>
                                    <input type="date" name="settings[academic_year_end][value]" class="form-control" value="{{ $settings['academic']->where('key', 'academic_year_end')->first()?->value ?? '2025-03-31' }}">
                                    <input type="hidden" name="settings[academic_year_end][key]" value="academic_year_end">
                                    <input type="hidden" name="settings[academic_year_end][type]" value="string">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Current Semester</label>
                                    <select name="settings[current_semester][value]" class="form-select">
                                        <option value="1" {{ ($settings['academic']->where('key', 'current_semester')->first()?->value ?? '1') == '1' ? 'selected' : '' }}>Semester 1</option>
                                        <option value="2" {{ ($settings['academic']->where('key', 'current_semester')->first()?->value ?? '1') == '2' ? 'selected' : '' }}>Semester 2</option>
                                        <option value="3" {{ ($settings['academic']->where('key', 'current_semester')->first()?->value ?? '1') == '3' ? 'selected' : '' }}>Summer Semester</option>
                                    </select>
                                    <input type="hidden" name="settings[current_semester][key]" value="current_semester">
                                    <input type="hidden" name="settings[current_semester][type]" value="string">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Grading Scale</label>
                                    <select name="settings[grading_scale][value]" class="form-select">
                                        <option value="letter" {{ ($settings['academic']->where('key', 'grading_scale')->first()?->value ?? 'letter') == 'letter' ? 'selected' : '' }}>Letter Grades (A-F)</option>
                                        <option value="percentage" {{ ($settings['academic']->where('key', 'grading_scale')->first()?->value ?? 'letter') == 'percentage' ? 'selected' : '' }}>Percentage Scale</option>
                                        <option value="gpa" {{ ($settings['academic']->where('key', 'grading_scale')->first()?->value ?? 'letter') == 'gpa' ? 'selected' : '' }}>GPA Scale (4.0)</option>
                                    </select>
                                    <input type="hidden" name="settings[grading_scale][key]" value="grading_scale">
                                    <input type="hidden" name="settings[grading_scale][type]" value="string">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save Academic Settings
                            </button>
                        </form>
                    </div>

                    <!-- Student Settings -->
                    <div class="tab-pane mt-3" id="student">
                        <h3 style="color: #6C3428;"><i class="fas fa-user-graduate me-2"></i>Student Settings</h3>
                        <form id="student-form" method="POST" action="{{ route('admin.settings.update', 'student') }}">
                            @csrf
                            <input type="hidden" name="group" value="student">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Minimum Admission Age</label>
                                    <input type="number" name="settings[min_admission_age][value]" class="form-control" value="{{ $settings['student']->where('key', 'min_admission_age')->first()?->value ?? '16' }}">
                                    <input type="hidden" name="settings[min_admission_age][key]" value="min_admission_age">
                                    <input type="hidden" name="settings[min_admission_age][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Minimum GPA for Graduation</label>
                                    <input type="number" step="0.1" name="settings[min_graduation_gpa][value]" class="form-control" value="{{ $settings['student']->where('key', 'min_graduation_gpa')->first()?->value ?? '2.0' }}">
                                    <input type="hidden" name="settings[min_graduation_gpa][key]" value="min_graduation_gpa">
                                    <input type="hidden" name="settings[min_graduation_gpa][type]" value="string">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Required Community Service Hours</label>
                                    <input type="number" name="settings[community_service_hours][value]" class="form-control" value="{{ $settings['student']->where('key', 'community_service_hours')->first()?->value ?? '40' }}">
                                    <input type="hidden" name="settings[community_service_hours][key]" value="community_service_hours">
                                    <input type="hidden" name="settings[community_service_hours][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Minimum Attendance Percentage</label>
                                    <input type="number" name="settings[min_attendance_percentage][value]" class="form-control" value="{{ $settings['student']->where('key', 'min_attendance_percentage')->first()?->value ?? '75' }}">
                                    <input type="hidden" name="settings[min_attendance_percentage][key]" value="min_attendance_percentage">
                                    <input type="hidden" name="settings[min_attendance_percentage][type]" value="integer">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save Student Settings
                            </button>
                        </form>
                    </div>

                    <!-- Faculty Settings -->
                    <div class="tab-pane mt-3" id="faculty">
                        <h3 style="color: #6C3428;"><i class="fas fa-chalkboard-teacher me-2"></i>Faculty Settings</h3>
                        <form id="faculty-form" method="POST" action="{{ route('admin.settings.update', 'faculty') }}">
                            @csrf
                            <input type="hidden" name="group" value="faculty">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Standard Teaching Load (hours/week)</label>
                                    <input type="number" name="settings[standard_teaching_load][value]" class="form-control" value="{{ $settings['faculty']->where('key', 'standard_teaching_load')->first()?->value ?? '12' }}">
                                    <input type="hidden" name="settings[standard_teaching_load][key]" value="standard_teaching_load">
                                    <input type="hidden" name="settings[standard_teaching_load][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Maximum Teaching Load</label>
                                    <input type="number" name="settings[max_teaching_load][value]" class="form-control" value="{{ $settings['faculty']->where('key', 'max_teaching_load')->first()?->value ?? '18' }}">
                                    <input type="hidden" name="settings[max_teaching_load][key]" value="max_teaching_load">
                                    <input type="hidden" name="settings[max_teaching_load][type]" value="integer">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Annual Leave Days</label>
                                    <input type="number" name="settings[annual_leave_days][value]" class="form-control" value="{{ $settings['faculty']->where('key', 'annual_leave_days')->first()?->value ?? '30' }}">
                                    <input type="hidden" name="settings[annual_leave_days][key]" value="annual_leave_days">
                                    <input type="hidden" name="settings[annual_leave_days][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Sick Leave Days</label>
                                    <input type="number" name="settings[sick_leave_days][value]" class="form-control" value="{{ $settings['faculty']->where('key', 'sick_leave_days')->first()?->value ?? '15' }}">
                                    <input type="hidden" name="settings[sick_leave_days][key]" value="sick_leave_days">
                                    <input type="hidden" name="settings[sick_leave_days][type]" value="integer">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save Faculty Settings
                            </button>
                        </form>
                    </div>

                    <!-- Finance Settings -->
                    <div class="tab-pane mt-3" id="finance">
                        <h3 style="color: #6C3428;"><i class="fas fa-money-bill-wave me-2"></i>Finance Settings</h3>
                        <form id="finance-form" method="POST" action="{{ route('admin.settings.update', 'finance') }}">
                            @csrf
                            <input type="hidden" name="group" value="finance">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Base Tuition per Credit ($)</label>
                                    <input type="number" step="0.01" name="settings[base_tuition_per_credit][value]" class="form-control" value="{{ $settings['finance']->where('key', 'base_tuition_per_credit')->first()?->value ?? '150.00' }}">
                                    <input type="hidden" name="settings[base_tuition_per_credit][key]" value="base_tuition_per_credit">
                                    <input type="hidden" name="settings[base_tuition_per_credit][type]" value="string">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Merit Scholarship Threshold (GPA)</label>
                                    <input type="number" step="0.1" name="settings[merit_scholarship_threshold][value]" class="form-control" value="{{ $settings['finance']->where('key', 'merit_scholarship_threshold')->first()?->value ?? '3.5' }}">
                                    <input type="hidden" name="settings[merit_scholarship_threshold][key]" value="merit_scholarship_threshold">
                                    <input type="hidden" name="settings[merit_scholarship_threshold][type]" value="string">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Merit Scholarship Discount (%)</label>
                                    <input type="number" name="settings[merit_scholarship_discount][value]" class="form-control" value="{{ $settings['finance']->where('key', 'merit_scholarship_discount')->first()?->value ?? '25' }}">
                                    <input type="hidden" name="settings[merit_scholarship_discount][key]" value="merit_scholarship_discount">
                                    <input type="hidden" name="settings[merit_scholarship_discount][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Late Payment Fee (%)</label>
                                    <input type="number" name="settings[late_payment_fee][value]" class="form-control" value="{{ $settings['finance']->where('key', 'late_payment_fee')->first()?->value ?? '5' }}">
                                    <input type="hidden" name="settings[late_payment_fee][key]" value="late_payment_fee">
                                    <input type="hidden" name="settings[late_payment_fee][type]" value="integer">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save Finance Settings
                            </button>
                        </form>
                    </div>

                    <!-- System Settings -->
                    <div class="tab-pane mt-3" id="system">
                        <h3 style="color: #6C3428;"><i class="fas fa-desktop me-2"></i>System Settings</h3>
                        <form id="system-form" method="POST" action="{{ route('admin.settings.update', 'system') }}">
                            @csrf
                            <input type="hidden" name="group" value="system">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Session Timeout (minutes)</label>
                                    <input type="number" name="settings[session_timeout][value]" class="form-control" value="{{ $settings['system']->where('key', 'session_timeout')->first()?->value ?? '60' }}">
                                    <input type="hidden" name="settings[session_timeout][key]" value="session_timeout">
                                    <input type="hidden" name="settings[session_timeout][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Backup Frequency</label>
                                    <select name="settings[backup_frequency][value]" class="form-select">
                                        <option value="daily" {{ ($settings['system']->where('key', 'backup_frequency')->first()?->value ?? 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ ($settings['system']->where('key', 'backup_frequency')->first()?->value ?? 'daily') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ ($settings['system']->where('key', 'backup_frequency')->first()?->value ?? 'daily') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    </select>
                                    <input type="hidden" name="settings[backup_frequency][key]" value="backup_frequency">
                                    <input type="hidden" name="settings[backup_frequency][type]" value="string">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Maintenance Mode</label>
                                    <select name="settings[maintenance_mode][value]" class="form-select">
                                        <option value="0" {{ ($settings['system']->where('key', 'maintenance_mode')->first()?->value ?? '0') == '0' ? 'selected' : '' }}>Disabled</option>
                                        <option value="1" {{ ($settings['system']->where('key', 'maintenance_mode')->first()?->value ?? '0') == '1' ? 'selected' : '' }}>Enabled</option>
                                    </select>
                                    <input type="hidden" name="settings[maintenance_mode][key]" value="maintenance_mode">
                                    <input type="hidden" name="settings[maintenance_mode][type]" value="boolean">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">System Language</label>
                                    <select name="settings[system_language][value]" class="form-select">
                                        <option value="en" {{ ($settings['system']->where('key', 'system_language')->first()?->value ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="my" {{ ($settings['system']->where('key', 'system_language')->first()?->value ?? 'en') == 'my' ? 'selected' : '' }}>Myanmar</option>
                                    </select>
                                    <input type="hidden" name="settings[system_language][key]" value="system_language">
                                    <input type="hidden" name="settings[system_language][type]" value="string">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save System Settings
                            </button>
                        </form>
                    </div>



                    <!-- Security Settings -->
                    <div class="tab-pane mt-3" id="security">
                        <h3 style="color: #6C3428;"><i class="fas fa-shield-alt me-2"></i>Security Settings</h3>
                        <form id="security-form" method="POST" action="{{ route('admin.settings.update', 'security') }}">
                            @csrf
                            <input type="hidden" name="group" value="security">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Maximum Login Attempts</label>
                                    <input type="number" name="settings[max_login_attempts][value]" class="form-control" value="{{ $settings['security']->where('key', 'max_login_attempts')->first()?->value ?? '5' }}">
                                    <input type="hidden" name="settings[max_login_attempts][key]" value="max_login_attempts">
                                    <input type="hidden" name="settings[max_login_attempts][type]" value="integer">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Lockout Duration (minutes)</label>
                                    <input type="number" name="settings[lockout_duration][value]" class="form-control" value="{{ $settings['security']->where('key', 'lockout_duration')->first()?->value ?? '30' }}">
                                    <input type="hidden" name="settings[lockout_duration][key]" value="lockout_duration">
                                    <input type="hidden" name="settings[lockout_duration][type]" value="integer">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Force Password Change on First Login</label>
                                    <select name="settings[force_password_change][value]" class="form-select">
                                        <option value="1" {{ ($settings['security']->where('key', 'force_password_change')->first()?->value ?? '1') == '1' ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ ($settings['security']->where('key', 'force_password_change')->first()?->value ?? '1') == '0' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                    <input type="hidden" name="settings[force_password_change][key]" value="force_password_change">
                                    <input type="hidden" name="settings[force_password_change][type]" value="boolean">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" style="color: #6C3428;">Encrypt Sensitive Data</label>
                                    <select name="settings[encrypt_sensitive_data][value]" class="form-select">
                                        <option value="1" {{ ($settings['security']->where('key', 'encrypt_sensitive_data')->first()?->value ?? '1') == '1' ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ ($settings['security']->where('key', 'encrypt_sensitive_data')->first()?->value ?? '1') == '0' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                    <input type="hidden" name="settings[encrypt_sensitive_data][key]" value="encrypt_sensitive_data">
                                    <input type="hidden" name="settings[encrypt_sensitive_data][type]" value="boolean">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="color: white; background-color: #FF7300; border: none; padding: 8px; border-radius: 10px;">
                                <i class="fas fa-save me-1"></i>Save Security Settings
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons and panes
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.remove('active'));

                    // Add active class to clicked button and corresponding pane
                    this.classList.add('active');
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>
@endsection
