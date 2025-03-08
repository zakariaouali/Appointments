<x-nav/>

<div class="appointment-container">
    <div class="appointment-card">
        <h2 class="title">Appointment Details</h2>

        <div class="appointment-info">
            <div class="info-item">
                <i class="fa fa-user"></i>
                <span>Name:</span>
                <strong>{{ $appointment->full_name }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-envelope"></i>
                <span>Email:</span>
                <strong>{{ $appointment->email }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-phone"></i>
                <span>Phone:</span>
                <strong>{{ $appointment->phone }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-calendar"></i>
                <span>Date:</span>
                <strong>{{ $appointment->desired_date }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-clock"></i>
                <span>Time:</span>
                <strong>{{ $appointment->desired_time }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-stethoscope"></i>
                <span>Specialty:</span>
                <strong>{{ $appointment->specialty }}</strong>
            </div>

            <div class="info-item status">
                <i class="fa fa-info-circle"></i>
                <span>Status:</span>
                <strong class="status-label {{ strtolower($appointment->status) }}">
                    {{ ucfirst($appointment->status) }}
                </strong>
            </div>

            <div class="info-item comments">
                <i class="fa fa-comment"></i>
                <p>{{ $appointment->comments ?: 'No comments provided' }}</p>
            </div>
        </div>
        
        <div class="actions">
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-back">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .appointment-container {
        margin-left: 10%;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .appointment-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 450px;
        text-align: center;
    }

    .title {
        font-size: 26px;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        display: inline-block;
    }

    .appointment-info {
        display: grid;
        grid-template-columns: 1fr;
        gap: 15px;
        text-align: left;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f9fc;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        color: #555;
    }

    .info-item i {
        font-size: 18px;
        color: #007bff;
    }

    .info-item span {
        font-weight: 600;
        color: #333;
    }

    .info-item strong {
        margin-left: auto;
        color: #222;
    }

    /* Status Colors */
    .status-label {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .status-label.pending {
        background-color: #ffcc00;
        color: #333;
    }

    .status-label.confirmed {
        background-color: #28a745;
        color: white;
    }

    .status-label.cancelled {
        background-color: #dc3545;
        color: white;
    }

    /* New Completed Status */
    .status-label.completed {
        background-color: #28a745; /* Green color */
        color: white;
    }

    /* Comments Section */
    .comments {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        background: #eef2f7;
        padding: 15px;
        border-radius: 8px;
    }

    .comments p {
        margin: 5px 0 0;
        font-style: italic;
        color: #444;
        word-break: break-word;
    }

    .actions {
        margin-top: 20px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .btn-back {
        background-color: #007bff;
        color: white;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }

    @media screen and (max-width: 600px) {
        .appointment-card {
            width: 90%;
            padding: 20px;
        }

        .title {
            font-size: 22px;
        }

        .info-item {
            font-size: 14px;
        }

        .status-label {
            font-size: 14px;
            padding: 4px 8px;
        }
    }
</style>
