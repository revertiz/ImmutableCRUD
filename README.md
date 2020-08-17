## Immutable CRUD MVC app
CRUD app created for learning purposes (PHP+MYSQL). Includes 2 pages: list page and form page for adding new jokes. Each page has it's own model, view and controller. The view queries database directly, allowing for better model reusability. Most of the logic is inside models which results in lean controllers that contain little logic. The only job of controllers is to get user's input and invoke correct method.

#### Features:
- Routing
- Dependency Injection Container
- Immutable objects
- CRUD functionality
- Sort, search functionality
- Pagination
- Form validation
