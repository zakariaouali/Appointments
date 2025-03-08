<!-- filepath: /c:/Users/User/OneDrive/Desktop/OWFS/laravel/PFE/admin/resources/views/patient-view.blade.php -->
<x-nav/>

<div class="appointment-container">
    <div class="appointment-card">
        <h2 class="title">Patient Details</h2>

        <div class="appointment-info">
            <div class="info-item">
                <i class="fa fa-user"></i>
                <span>Name:</span>
                <strong>{{ $patient->full_name }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-calendar"></i>
                <span>BirthDate:</span>
                <strong>{{ $patient->birthdate }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-envelope"></i>
                <span>Email:</span>
                <strong>{{ $patient->email }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-phone"></i>
                <span>Phone:</span>
                <strong>{{ $patient->phone }}</strong>
            </div>
            <div class="info-item">
                <i class="fa fa-clock"></i>
                <span>Created at :</span>
                <strong>{{ $patient->created_at }}</strong>
            </div>
        </div>
        
        <div class="actions">
            <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-update">
                <i class="fa fa-edit"></i> Update
            </a>
            <a href="{{ route('admin.patients.history', $patient->id) }}" class="btn btn-history">
                <i class="fa fa-history"></i> History
            </a>
            <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $patient->id }}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-delete" onclick="confirmDelete({{ $patient->id }})">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </div>
        
        <div class="actions">
            <a href="{{ route('admin.patients.index') }}" class="btn btn-back">
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

    .actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
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
        margin: 5px;
    }

    .btn-back {
        background-color: #007bff;
        color: white;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }

    .btn-update {
        background-color: #28a745;
        color: white;
    }

    .btn-update:hover {
        background-color: #218838;
    }

    .btn-history {
        background-color: #17a2b8;
        color: white;
    }

    .btn-history:hover {
        background-color: #138496;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }

    .btn-delete:hover {
        background-color: #c82333;
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

        .actions {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            margin: 5px 0;
        }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(patientId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to recover this patient!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + patientId).submit();
            }
        });
    }
</script>