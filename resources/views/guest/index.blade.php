<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Upload Portal - PT. Mandajaya Rekayasa Konstruksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <style>
    body {
      min-height: 100vh;
      background: #f4f6f8;
    }

    .main-container {
      display: flex;
    }

    .sidebar {
      width: 250px;
      background-color: #003c3c;
      color: white;
      min-height: 100vh;
      padding-top: 40px;
      position: fixed;
    }

    .sidebar a {
      display: block;
      padding: 15px 25px;
      color: white;
      text-decoration: none;
      transition: background 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #005c5c;
    }

    .sidebar a.active {
      background-color: #00acc1;
      font-weight: bold;
    }

    .content-wrapper {
      margin-left: 250px;
      flex-grow: 1;
      background: linear-gradient(135deg, #004d40, #00acc1);
      padding: 40px 20px;
      position: relative;
    }

    #particles-js {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
    }

    .content-inner {
      position: relative;
      z-index: 2;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card-header {
      border-radius: 12px 12px 0 0 !important;
      font-weight: 600;
    }

    .btn-primary {
      background: linear-gradient(45deg, #3f51b5, #1a237e);
      border: none;
      padding: 10px 24px;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background: linear-gradient(45deg, #1a237e, #3f51b5);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(63,81,181,0.3);
    }

    .btn-secondary {
      background-color: #e3f2fd;
      color: #0d47a1;
      border: none;
      padding: 10px 24px;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
    }

    .btn-secondary:hover {
      background-color: #bbdefb;
      color: #0d47a1;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(13,71,161,0.2);
    }

    .form-control {
      border: 1px solid #dcdcdc;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #3f51b5;
      box-shadow: 0 0 0 0.2rem rgba(63,81,181,0.2);
      background: #ffffff;
    }
  </style>
</head>
<body>
<div class="main-container">
  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="text-center mb-4">
      <h5 class="fw-bold">Mandajaya</h5>
    </div>
    <a href="#" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="#"><i class="fas fa-chart-line me-2"></i> View Score</a>
  </nav>

  <!-- Content -->
  <div class="content-wrapper">
    <div id="particles-js"></div>
    <div class="content-inner">
      <div class="container py-5">
        <div class="mb-5 text-center text-white">
          <h2 class="fw-bold">Document Upload Portal</h2>
          <p>Watch the tutorial and choose your upload method below.</p>
        </div>

        <!-- Video Tutorial -->
        <div class="card mb-4">
          <div class="card-header bg-primary text-white">Tutorial Video</div>
          <div class="card-body">
            <div class="ratio ratio-16x9 mb-3">
              <iframe src="https://www.youtube.com/embed/your-video-id" title="Tutorial Video" allowfullscreen></iframe>
            </div>
            <p class="text-muted mb-0">Watch this tutorial video to understand how to properly submit your documents.</p>
          </div>
        </div>

        <!-- Upload Method -->
        <div class="row mb-5 g-4">
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body text-center p-4">
                <h5 class="card-title fw-bold mb-3">Self Upload</h5>
                <p class="card-text mb-4">Upload and manage your documents directly.</p>
                <a href="{{ route('guest.upload') }}" class="btn btn-primary">Upload Documents</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body text-center p-4">
                <h5 class="card-title fw-bold mb-3">Request Upload Assistance</h5>
                <p class="card-text mb-4">Let our team handle your document upload and verification.</p>
                <form action="{{ route('guest.upload.request') }}" method="POST">
                  @csrf
                  <textarea name="notes" class="form-control mb-3" rows="3" placeholder="Describe the documents you need help with" required></textarea>
                  <button type="submit" class="btn btn-secondary">Submit Request</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    particlesJS('particles-js', {
      particles: {
        number: { value: 60, density: { enable: true, value_area: 1000 } },
        color: { value: '#ffffff' },
        shape: { type: 'circle' },
        opacity: { value: 0.3, random: true },
        size: { value: 5, random: true },
        line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.2, width: 1 },
        move: { enable: true, speed: 1.5, random: true }
      },
      interactivity: {
        detect_on: 'canvas',
        events: {
          onhover: { enable: true, mode: 'bubble' },
          onclick: { enable: true, mode: 'push' },
          resize: true
        },
        modes: {
          bubble: { distance: 200, size: 6, duration: 2, opacity: 0.4, speed: 2 },
          push: { particles_nb: 4 }
        }
      },
      retina_detect: true
    });
  });
</script>
</body>
</html>