<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General body and font styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            display: flex;
        }

        /* Dashboard content */
        .container {
            margin-left: 250px;
            width: 90%;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 32px;
        }

        /* Card styling */
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px;
            text-align: center;
            flex: 1;
        }

        .card h2 {
            margin: 0;
            color: #333;
        }

        .card p {
            color: #555;
            font-size: 20px;
            font-weight: bold;
        }

       /* Quick stats */
       .quick-stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .quick-stats .card {
            flex: 1 1 calc(33.33% - 20px);
        }
        /* Chart container */
        .chart-container {
            
            width: 48%;
            max-width: 100%;
            margin-right: 5px;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .chart-container-last {
            
            width: 100%;
            height: 700px;
            margin-right: 5px;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;    
        }

        .chart-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-content: center;
            justify-content: center;
        }
        

    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <x-nav/>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <div class="quick-stats">
            <div class="card">
                <h2>Today's Appointments</h2>
                <p>{{ $todayAppointments }}</p>
            </div>
            <div class="card">
                <h2>Upcoming Appointments</h2>
                <p>{{ $upcomingAppointments }}</p>
            </div>


        </div>
        
        <!-- Chart Section -->
        <div class="chart-wrapper">
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="chart-container-last">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

    
        <div class="quick-stats">
            <div class="card">
                <h2>Pending Appointments</h2>
                <p>{{ $pendingAppointments }}</p>
            </div>

            <div class="card">
                <h2>Total Patients</h2>
                <p>{{ $totalPatients }}</p>
            </div>
            <div class="card">
                <h2>Most Requested Specialty</h2>
                <p>{{ $mostRequestedSpecialty }}</p>
            </div>
            <div class="card">
                <h2>Past Appointments</h2>
                <p>{{ $pastAppointments }}</p>
            </div>
        </div>
        
        
    </div>

    <script>



// Specialties for the chart
var specialties = ['Omnipractice', 'Diabetology', 'Nutrition', 'Homeopathy', 'Cupping Therapy'];

// Example data from the controller (you can replace it with your actual data)
var appointmentsBySpecialty = @json($appointmentsBySpecialty);

// Prepare the data for the chart (if any specialty doesn't have data, default to 0)
var data = specialties.map(specialty => appointmentsBySpecialty[specialty] || 0);

// Get the context for the bar chart
var barCtx = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(barCtx, {
    type: 'bar',  // Change to bar chart
    data: {
        labels: Object.keys(appointmentsBySpecialty),  // Use the specialties as labels
        datasets: [{
            label: 'Appointments by Specialty',
            data: Object.values(appointmentsBySpecialty),  // Use the appointment count as data
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',  // Red
                'rgba(54, 162, 235, 0.6)',  // Blue
                'rgba(255, 206, 86, 0.6)',  // Yellow
                'rgba(75, 192, 192, 0.6)',  // Teal
                'rgba(153, 102, 255, 0.6)'  // Purple
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',  // Red
                'rgba(54, 162, 235, 1)',  // Blue
                'rgba(255, 206, 86, 1)',  // Yellow
                'rgba(75, 192, 192, 1)',  // Teal
                'rgba(153, 102, 255, 1)'  // Purple
            ],
            borderWidth: 2,
            borderRadius: 8,  // Rounded corners for bars
            hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)',  // Hover effect for bars
            hoverBorderColor: 'rgba(75, 192, 192, 1)',  // Hover effect for borders
            hoverBorderWidth: 3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Appointments by Specialty',
                font: {
                    family: 'Arial, sans-serif',
                    size: 20,
                    weight: 'bold'
                },
                padding: { bottom: 20 }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.raw || 0;
                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = ((value / total) * 100).toFixed(2);
                        return label + ': ' + value + ' (' + percentage + '%)';
                    }
                },
                backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Dark tooltip background
                titleColor: '#fff',
                bodyColor: '#fff',
                borderRadius: 5,
                padding: 10
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Appointments',
                    font: {
                        family: 'Arial, sans-serif',
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                grid: {
                    borderColor: 'rgba(0, 0, 0, 0.1)', // Lighter grid lines
                    lineWidth: 1
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Specialty',
                    font: {
                        family: 'Arial, sans-serif',
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                grid: {
                    display: false // Remove grid lines for x-axis
                },
                ticks: {
                    autoSkip: false,  // Don't skip any label
                    maxRotation: 0,   // Prevent label rotation (keep them straight)
                    minRotation: 0    // Prevent label rotation (keep them straight)
                }
            }
        },
        animation: {
            duration: 1000, // Smooth animation on chart rendering
            easing: 'easeInOutQuad' // Smooth easing
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        }
    }
});





var monthsMap = {
    1: 'January', 2: 'February', 3: 'March', 4: 'April', 5: 'May', 6: 'June',
    7: 'July', 8: 'August', 9: 'September', 10: 'October', 11: 'November', 12: 'December'
};

var appointmentsByMonth = @json($appointmentsByMonth);
var labels = Object.keys(appointmentsByMonth).map(month => monthsMap[month]);

var lineCtx = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: labels,  // Use month names instead of numbers
        datasets: [{
            label: 'Appointments',
            data: Object.values(appointmentsByMonth),
            backgroundColor: 'rgba(75, 192, 192, 0.3)',  // Soft background fill
            borderColor: 'rgba(75, 192, 192, 1)',  // Bright line color
            borderWidth: 3,  // Thicker border for visibility
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',  // Circle point color
            pointBorderColor: '#fff',  // White border around points
            pointBorderWidth: 2,  // Border width around points
            pointRadius: 5,  // Larger points
            fill: true,  // Filled line under the chart
            tension: 0.4  // Smooth curve for the line
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Appointments Trend Over the Past Year',
                font: {
                    family: 'Arial, sans-serif',
                    size: 18,
                    weight: 'bold'
                },
                color: '#333',
                padding: { bottom: 20 }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Darker tooltip background
                titleColor: '#fff',  // White title in tooltip
                bodyColor: '#fff',  // White body in tooltip
                borderRadius: 5,  // Rounded corners for tooltip
                padding: 10,
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.raw; // Display rounded value
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Appointments',
                    font: {
                        family: 'Arial, sans-serif',
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                grid: {
                    borderColor: 'rgba(0, 0, 0, 0.1)', // Light grid lines for better readability
                    lineWidth: 1
                },
                ticks: {
                    color: '#666'  // Ticks color
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Month',
                    font: {
                        family: 'Arial, sans-serif',
                        size: 14,
                        weight: 'bold'
                    },
                    color: '#666'
                },
                grid: {
                    display: false  // Remove grid lines for x-axis
                },
                ticks: {
                    color: '#666'  // Ticks color
                }
            }
        },
        animation: {
            duration: 1000,  // Smooth animation on chart rendering
            easing: 'easeInOutQuad'  // Smooth easing
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        }
    }
});




var doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
var doughnutChart = new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(@json($appointmentsByStatus)),
        datasets: [{
            label: 'Appointments',
            data: Object.values(@json($appointmentsByStatus)),
            backgroundColor: [
                'rgba(0,255,0)',    //  (approved)
                'rgba(139,0,0)',  // Medium Green (canceled)
                'rgba(0,128,0)',  // Orange (Completed)
                'rgba(255, 165, 0, 0.2)'     // Red (Pending)
            ],
            borderColor: [
                'rgba(0, 128, 0, 1)',
                'rgba(34, 139, 34, 1)',
                'rgba(255, 165, 0, 1)',
                'rgba(255, 0, 0, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Appointments by Status',
                font: {
                    family: 'Arial, sans-serif',
                    size: 18,
                    weight: 'bold'
                },
                padding: { bottom: 20 }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.raw || 0;
                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = ((value / total) * 100).toFixed(2);
                        return label + ': ' + value + ' (' + percentage + '%)';
                    }
                },
                backgroundColor: 'rgba(0, 0, 0, 0.7)',  // Dark tooltip background
                titleColor: '#fff',
                bodyColor: '#fff',
                borderRadius: 5,
                padding: 10
            }
        }
    }
});


        

        </script>
</body>
</html>
