## Acount Permission System( Laravel && React project)

## Purpose
    - The account permissions system is designed to control access to resources and actions on the e-commerce website based on user roles and account statuses. 
    - This system ensures that users can only perform actions and access resources that their roles permit, enhancing both security and user experience.

## Roles and Permissions Management

- Table Schemas
    -  roles: Stores role data. 
              Each role record includes fields like id (primary key), name (role name), and timestamps.
    -  permissions: Contains permission details. 
                    Fields include id, name (name of the permission), and guard_name (used by Spatie's package).
    -  role_user: A pivot table linking users to roles.     
                  Fields are user_id and role_id, both acting as foreign keys and a composite primary key.
    -  permission_role: Another pivot table that associates permissions with roles. 
                        It includes permission_id and role_id, forming a composite primary key.

 - Role and Permission Assignment
    - Roles and permissions are assigned using Spatie’s Laravel-Permission package. 
      Methods such as `assignRole` and `givePermissionTo` are used for this purpose. 
      For instance:
      ```
        $user->assignRole('editor');
        $role->givePermissionTo('edit product');
      ```
 - Middleware
    - Custom middleware is implemented to check user permissions on routes. 
      This middleware validates if the logged-in user has the necessary role or permission before accessing certain resources:
      ```
      public function handle($request, Closure $next, $role)
      {
          if (!$request->user()->hasRole($role)) {
              // Redirect or handle unauthorized access
          }
          return $next($request);
      }
      ```
## Product Access Control

 - Implementation in Product Listing
    - Product visibility is controlled by checking the logged-in user's permissions. 
      In the `ProductController`, I implement logic to filter product listings:

      ```
        public function index()
        {
            if (auth()->user()->can('view products')) {
                $products = Product::all();
                return view('products.index', compact('products'));
            }
            return redirect('home')->with('error', 'Unauthorized access');
        }
      ```

## Checkout Restriction Base on Account Status

 - Account Status Tracking
    - Users' account statuses, such as is_overdue, are tracked within the users table. 
      This field is updated based on the user's account activity.

 - Checkout Logic
    - The CheckoutController contains logic to restrict the checkout process for users whose accounts are overdue:

    ```
    public function checkout(Request $request)
    {
        if (auth()->user()->is_overdue) {
            return redirect()->back()->withErrors('Account is overdue. Please settle to proceed.');
        }
        // Proceed with checkout process
    }
    ```

## Handling New Permissions

 - Dynamic permission assignment is handled via an admin interface, where new permissions can be created and assigned to roles without altering the codebase. 
   This approach provides flexibility in managing access controls as the application evolves.

## Security Considerations

 - Security measures include:

   - Encryption of sensitive user data.
   - Using Laravel's built-in protection against SQL injection, CSRF, and XSS.
   - Role and permission manipulation restricted to authorized personnel only.

## Testing and Validation

 - Extensive testing was conducted, including:

    - Unit tests for role and permission assignments.
    - Functional tests for product access control based on permissions.
    - Testing checkout restrictions for overdue accounts under various scenarios.

## Challenges and Solutions

- Challenge: Implementing dynamic permission updates without code changes.
- Solution: Utilized Spatie’s Laravel-Permission package for flexibility in permission management.