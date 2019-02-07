<?php

namespace App\Mail;

use App\Entities\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewStudentInCourse extends Mailable
{
    private $course;
    private $studentName;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( ? Course $course, $studentName)
    {
        $this->course       = $course;
        $this->$studentName = $studentName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("Nuevo estudiante inscrito en el curso"))
            ->markDown('emails.new_student_in_course')
            ->with('course', $this->course)
            ->with('student', $this->studentName);
    }
}
