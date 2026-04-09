# Image Search App
This is a full-stack image search application built using Laravel (backend) and Vue.js (frontend).
Users can search for images by keyword, and results are fetched from the Pexels API.

## Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Vue.js (Vite)
* **API:** Pexels API
  
## Backend (Laravel)

* REST API endpoint:
  `GET /api/images?query={keyword}`
* Fetches images from the Pexels API
* Implements caching (TTL: 60 seconds)
* Returns JSON response:

## Frontend (Vue.js)

* Search input and button
* Displays images in a grid layout
* Shows photographer name
* Loading state and error handling

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/image-search-app.git
cd image-search-app
```
### 2. Backend Setup (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Add your Pexels API key to `.env.example`:

```
PEXELS_API_KEY= add_your_api_key_here
```

Backend will run at:

```
http://127.0.0.1:8000
```

---

### 3. Frontend Setup (Vue)

```bash
cd frontend
npm install
npm run dev
```

Frontend will run at:

```
http://localhost:5173
```

## Usage

1. Open the frontend in your browser
2. Enter a search term (e.g. "cats")
3. Click search
4. Images will be displayed with photographer names

## Notes

* The frontend currently connects to:

  ```
  http://127.0.0.1:8000
  ```

  Ensure the backend is running on this port.

* Caching is implemented to reduce repeated API calls.
