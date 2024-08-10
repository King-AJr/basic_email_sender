<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatientUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $patient_name;
    public $x_ray;
    public $ultrasound_scan;
    public $ct_scan;
    public $mri;

    /**
     * Create a new message instance.
     */
    public function __construct($patient_name, $x_ray, $ultrasound_scan, $ct_scan, $mri)
    {
        $this->patient_name = $patient_name;
        $this->x_ray = $x_ray;
        $this->ultrasound_scan = $ultrasound_scan;
        $this->ct_scan = $ct_scan;
        $this->mri = $mri;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->generateSubject(), // Set the dynamic subject
        );
    }

    /**
     * Generate the email subject.
     *
     * @return string
     */
    protected function generateSubject(): string
    {
        return "{$this->patient_name} medical data";
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.patient_update',
            with: [
                'patient_name' => $this->patient_name,
                'x_ray' => $this->x_ray,
                'ultrasound_scan' => $this->ultrasound_scan,
                'ct_scan' => $this->ct_scan,
                'mri' => $this->mri,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
