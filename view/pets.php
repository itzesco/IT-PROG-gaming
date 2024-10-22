<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets | Store Name</title>
    <link rel="stylesheet" href="../public/css/pets.css">
</head>
<body>
    <div class="topbar">
        <div class="storename">
            <h2>Bini's Buddies</h2>
        </div>
        <div class="navbar">
            <button onclick="document.location='home.php'">Home</button>
            <button onclick="document.location='about.php'">About</button>
            <button onclick="document.location='pets.php'">Pets</button>
            <button onclick="document.location='faq.php'">FAQs</button>
            <button onclick="document.location='user.php'" class="user"><img src="../public/images/user.png" alt="User"/></button>
        </div>
    </div>
  
    <div class="body">  
        <div class="search-bar">
            <form id="search-form" action="search.php" method="GET">
                <input type="text" placeholder="Search pets..." name="query" id="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
            <div class="filter">
                <button type="button" class="filter-button" id="filter-button">
                    Filter
                </button>
            </div>
        </div>

        <div class="gallery">
            <div class="imgcont">
                <!-- Dynamic content will be added here -->
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filter-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="close-modal">&times;</span>
            <h2>Filter Pets</h2>
            <label for="filter-type">Type:</label>
            <select id="filter-type" class="filter-type">
                <option value="all">All</option>
                <option value="Cat">Cat</option>
                <option value="Dog">Dog</option>
            </select>
            <label for="filter-breed">Breed:</label>
            <input type="text" id="filter-breed" placeholder="Enter breed...">
            <label for="filter-age">Age:</label>
            <input type="number" id="filter-age" placeholder="Enter max age">
            <label for="filter-gender">Gender:</label>
            <select id="filter-gender" class="filter-gender">
                <option value="all">All</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button id="apply-filters" class="apply-filters">Apply Filters</button>
        </div>
    </div>

    <!-- Pet Details Modal -->
    <div id="pet-modal" class="modal">
        <div class="modal-content">
            <span id="close-modal">&times;</span>
            <div class="availability-badge" id="availability-badge"></div>
            <h2 id="pet-name"></h2>
            <p>Type: <span id="pet-type"></span></p>
            <p>Breed: <span id="pet-breed"></span></p>
            <p>Availability: <span id="pet-availability"></span></p>
            <p>Age: <span id="pet-age"></span></p>
            <p>Gender: <span id="pet-gender"></span></p>
            <p>Personality: <span id="pet-personality"></span></p>
            <p>Coat: <span id="pet-coat"></span></p>
            <p>Eyes: <span id="pet-eyes"></span></p>
        </div>
    </div>

    <script>
        window.onload = function () {
            const pets = [
                { name: 'Peekaboo', type: 'Cat', breed: 'Domestic Cat', availability: 'Eligible', age: 3, gender: 'Male', personality: 'Friendly', coat: 'Gray, black, and white with black stripes and white paws', eyes: 'Bright yellow-green.', image: 'public/images/Peekaboo.png'},
                { name: 'Hansolo', type: 'Cat', breed: 'Domestic Cat', availability: 'Adopted', age: 2, gender: 'Male', personality: 'Extraverted', coat: 'Gray, black, and white with black stripes and white paws', eyes: 'Green', image: 'public/images/hansolo.png'},
                { name: 'Periwinkle', type: 'Cat', breed: 'Domestic Cat', availability: 'Eligible', age: 3, gender: 'Female', personality: 'Playful', coat: 'White with black markings on the head and tail', eyes: 'Bright yellow', image: 'public/images/periwinkle.png'},
                { name: 'Gustav', type: 'Dog', breed: 'Bichon Frise', availability: 'Adopted', age: 12, gender: 'Male', personality: 'Playful', coat: 'White', eyes: 'Brown', image: 'public/images/gustavo.png'},
                { name: 'Chanel', type: 'Dog', breed: 'Bichon Frise', availability: 'Eligible', age: 15, gender: 'Female', personality: 'Relaxed', coat: 'White', eyes: 'Brown', image: 'public/images/chanel.png'}
            ];

            const gallery = document.querySelector('.gallery .imgcont');
            const petModal = document.getElementById('pet-modal');
            const closeModal = document.getElementById('close-modal');

            const filterButton = document.getElementById('filter-button');
            const filterModal = document.getElementById('filter-modal');
            const applyFiltersButton = document.getElementById('apply-filters');
            const searchForm = document.getElementById('search-form');
            const searchInput = document.getElementById('search-input');

            function updateGallery(pets) {
                gallery.innerHTML = '';
                pets.forEach(pet => {
                    const polaroid = document.createElement('button');
                    polaroid.classList.add('polaroid');
                    polaroid.onclick = () => showPetDetails(pet);

                    const image = document.createElement('div');
                    image.classList.add('image');

                    
                    if (pet.image) {
                        image.style.backgroundImage = `url('${pet.image}')`;
                    }

                    const petName = document.createElement('p');
                    petName.classList.add('pet-name');
                    petName.textContent = pet.name;
                    
                    const heart = document.createElement('div');
                    heart.classList.add('heart');
                    heart.id = `heart-${pet.name}`;  // Assign unique ID based on pet name
                    heart.onclick = () => toggleHeart(pet.name);

                    polaroid.appendChild(image);
                    polaroid.appendChild(petName);
                    polaroid.appendChild(heart);
                    gallery.appendChild(polaroid);
                });
            }

            // Search for pets based on input
            const searchPets = (event) => {
                event.preventDefault(); // Prevent form submission
                const query = searchInput.value.toLowerCase();

                const filteredPets = pets.filter(pet => {
                    return pet.name.toLowerCase().includes(query) ||
                           pet.breed.toLowerCase().includes(query) ||
                           pet.type.toLowerCase().includes(query) ||
                           pet.gender.toLowerCase().includes(query);
                });

                updateGallery(filteredPets);
            };

            // Open modal
            filterButton.addEventListener('click', () => {
                filterModal.style.display = 'block';
            });

            // Close modal
            closeModal.addEventListener('click', () => {
                filterModal.style.display = 'none';
            });

            const applyFilters = () => {
                const selectedType = document.getElementById('filter-type').value;
                const breedInput = document.getElementById('filter-breed').value.toLowerCase();
                const maxAge = document.getElementById('filter-age').value;
                const selectedGender = document.getElementById('filter-gender').value;

                const filteredPets = pets.filter(pet => {
                    const matchesType = selectedType === 'all' || pet.type === selectedType;
                    const matchesBreed = breedInput === '' || pet.breed.toLowerCase().includes(breedInput);
                    const matchesAge = maxAge === '' || pet.age <= maxAge;
                    const matchesGender = selectedGender === 'all' || pet.gender === selectedGender;

                    return matchesType && matchesBreed && matchesAge && matchesGender;
                });

                updateGallery(filteredPets);
                filterModal.style.display = 'none';
            };

            searchForm.addEventListener('submit', searchPets);

            applyFiltersButton.addEventListener('click', applyFilters);

            // Add event listeners to inputs for Enter key
            const inputs = document.querySelectorAll('#filter-breed, #filter-age');
            inputs.forEach(input => {
                input.addEventListener('keypress', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault(); 
                        applyFilters();
                    }
                });
            });
            
            function showPetDetails(pet) {
                document.getElementById('pet-name').textContent = pet.name;
                document.getElementById('pet-type').textContent = pet.type;
                document.getElementById('pet-breed').textContent = pet.breed;
                document.getElementById('pet-availability').textContent = pet.availability;
                document.getElementById('pet-age').textContent = pet.age + ' years';
                document.getElementById('pet-gender').textContent = pet.gender;
                document.getElementById('pet-personality').textContent = pet.personality;
                document.getElementById('pet-coat').textContent = pet.coat;
                document.getElementById('pet-eyes').textContent = pet.eyes;

                const availabilityBadge = document.getElementById('availability-badge');
                availabilityBadge.innerHTML = ''; 
                
                if (pet.availability.toLowerCase() === 'eligible') {
                    availabilityBadge.innerHTML = '<button class="adopt-button">Adopt</button>';
                } else if (pet.availability.toLowerCase() === 'adopted') {
                    availabilityBadge.innerHTML = '<div class="taken-label">Taken</div>';
                }
                petModal.style.display = 'block';
            }
            
            closeModal.onclick = () => {
                petModal.style.display = 'none';
            };

            window.onclick = (event) => {
                if (event.target === petModal) {
                    petModal.style.display = 'none';
                }
            };

            updateGallery(pets);
        };
    </script>
</body>
</html>
