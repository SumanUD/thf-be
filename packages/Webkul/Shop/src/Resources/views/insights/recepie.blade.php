@php
    $recipeRepository = app('Webkul\CMS\Repositories\RecipeRepository');
    $recipes = $recipeRepository->where('status', 1)->get();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recipes | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <style>
        /* Shared Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Forum", serif; background: #0a0a0a; color: rgba(255, 255, 255, 0.9); line-height: 1.6; }
        .hero-banner { width: 100%; height: 400px; margin-top: 80px; background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)), url('{{ asset("thf-assets/images/recipe-banner.jpg") }}') center/cover; display: flex; align-items: center; justify-content: center; text-align: center; }
        .hero-title { font-size: 3.5rem; text-transform: uppercase; color: #fff; }
        .container { max-width: 1200px; margin: -80px auto 60px; padding: 0 40px; position: relative; z-index: 5; }
        .floating-card { background: rgba(15, 15, 15, 0.85); padding: 50px; border-radius: 24px; backdrop-filter: blur(20px); border: 1px solid rgba(212, 175, 55, 0.15); box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4); }
        .recipe-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; margin-top: 50px; }
        .recipe-card { background: rgba(20, 20, 20, 0.7); border-radius: 20px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.05); transition: 0.3s; display: flex; flex-direction: column; }
        .recipe-card:hover { transform: translateY(-10px); border-color: #d4af37; }
        .recipe-card-image { height: 240px; overflow: hidden; }
        .recipe-card-image img { width: 100%; height: 100%; object-fit: cover; }
        .recipe-card-content { padding: 25px; flex: 1; display: flex; flex-direction: column; }
        .recipe-card-title { font-size: 1.4rem; color: #fff; margin-bottom: 15px; }
        .recipe-card-link { color: #d4af37; text-decoration: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; margin-top: auto; border: none; background: none; font-family: inherit; font-size: 1rem; }
        
        /* Modal Styles */
        .recipe-modal { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.95); display: none; align-items: center; justify-content: center; z-index: 2000; backdrop-filter: blur(10px); padding: 40px 20px; }
        .recipe-modal.active { display: flex; }
        .recipe-modal-content { background: #111; border-radius: 24px; width: 95%; max-width: 900px; border: 1px solid #d4af3744; max-height: 90vh; overflow-y: auto; position: relative; }
        .modal-close { position: absolute; top: 20px; right: 20px; color: #d4af37; font-size: 1.5rem; cursor: pointer; z-index: 10; background: none; border: none; }
        .modal-body { padding: 40px; }
        .section-title { font-size: 1.8rem; color: #d4af37; margin: 25px 0 15px; border-bottom: 1px solid #d4af3722; }
        ul.ingredients-list, ol.instructions-list { list-style-position: inside; color: rgba(255,255,255,0.8); }
        li { margin-bottom: 10px; }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')

    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Sweet Recipes</div>
        </div>
    </div>

    <div class="container">
        <div class="floating-card">
            <div style="text-align:center;">
                <h1 style="font-size: 2.8rem; color: #fff;">Artisanal Recipes</h1>
                <p>Bring the magic of THF to your own kitchen.</p>
            </div>

            <div class="recipe-grid">
                @foreach($recipes as $recipe)
                    <div class="recipe-card">
                        <div class="recipe-card-image">
                            <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}">
                        </div>
                        <div class="recipe-card-content">
                            <h3 class="recipe-card-title">{{ $recipe->title }}</h3>
                            <p style="font-size: 0.9rem; color: rgba(255,255,255,0.6); margin-bottom: 15px;">
                                <i class="far fa-clock"></i> {{ $recipe->prep_time }} | {{ $recipe->difficulty }}
                            </p>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.95rem; margin-bottom: 20px;">{{ $recipe->description }}</p>
                            <button class="recipe-card-link" onclick="openRecipe({{ json_encode($recipe) }})">
                                View Full Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recipe Detail Modal -->
    <div class="recipe-modal" id="recipeModal">
        <div class="recipe-modal-content">
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            <div class="modal-body">
                <h2 id="modalTitle" style="font-size: 2.5rem; color: #fff; margin-bottom: 20px;"></h2>
                <img id="modalImage" src="" style="width: 100%; height: 300px; object-fit: cover; border-radius: 15px; margin-bottom: 20px;">
                
                <div class="recipe-content">
                    <h3 class="section-title">Ingredients</h3>
                    <ul class="ingredients-list" id="ingredientsList"></ul>

                    <h3 class="section-title">Instructions</h3>
                    <ol class="instructions-list" id="instructionsList"></ol>
                </div>
            </div>
        </div>
    </div>

    @include("shop::partials.thf-footer")

    <script>
        function openRecipe(recipe) {
            document.getElementById('modalTitle').textContent = recipe.title;
            document.getElementById('modalImage').src = recipe.image;
            
            const ingList = document.getElementById('ingredientsList');
            ingList.innerHTML = '';
            const ingredients = Array.isArray(recipe.ingredients) ? recipe.ingredients : JSON.parse(recipe.ingredients || '[]');
            ingredients.forEach(ing => {
                const li = document.createElement('li');
                li.textContent = ing;
                ingList.appendChild(li);
            });

            const insList = document.getElementById('instructionsList');
            insList.innerHTML = '';
            const instructions = Array.isArray(recipe.instructions) ? recipe.instructions : JSON.parse(recipe.instructions || '[]');
            instructions.forEach(ins => {
                const li = document.createElement('li');
                li.textContent = ins;
                insList.appendChild(li);
            });

            document.getElementById('recipeModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('recipeModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>
