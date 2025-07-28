<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Moderne | Tailwind CSS</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    transitionProperty: {
                        'width': 'width',
                        'spacing': 'margin, padding',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-item:hover .sidebar-icon {
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center ">
    <div class=" w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row ">
            <?php require_once ROOT_PATH . "/views/components/sidebar/sidebar.html.php"; ?>
        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col overflow-hidden ml-64">
            <?php require_once ROOT_PATH . "/views/components/header/header.html.php"; ?>
                <?= $content; ?>
        </div>
    </div>
    
    
</body>
</html>