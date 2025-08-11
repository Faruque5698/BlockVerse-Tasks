# Role-Based Access Control (RBAC) Documentation
## overview:
This system implements Role-Based Access Control (RBAC) where users are assigned roles, and roles have specific permissions. This allows fine-grained control over what actions a user can perform in the system based on their assigned roles.

## Database Tables:
roles table:

| Column     | Description                        |
|------------|------------------------------------|
| id         | Unique identifier for the role     |
| name       | Role name (e.g., admin, editor, author) |
| description| Description of the role            |
| created_at | Timestamp of creation               |
| updated_at | Timestamp of last update            |

Existing roles:

| id  | name   | description   |
|-----|--------|---------------|
| 1   | admin  | Administrator |
| 2   | editor | Editor        |
| 3   | author | Author        |

permissions table:

| Column     | Description                              |
|------------|------------------------------------------|
| id         | Unique identifier for permission         |
| name       | Permission code (e.g., create_article)   |
| description| Description of permission                |
| created_at | Timestamp of creation                    |
| updated_at | Timestamp of last update                 |


Existing permissions:

| id  | name               | description                |
|-----|--------------------|----------------------------|
| 1   | view_all_users     | View all users             |
| 2   | assign_roles       | Assign roles               |
| 3   | create_article     | Create article             |
| 4   | edit_own_article   | Edit own article           |
| 5   | publish_article    | Publish article            |
| 6   | delete_article     | Delete article             |
| 7   | view_published     | View published articles    |
| 8   | view_own_articles  | View own articles          |


permission_role table:

| Column       | Description                          |
|--------------|--------------------------------------|
| id           | Unique identifier for the record     |
| permission_id| Foreign key to permissions.id        |
| role_id      | Foreign key to roles.id              |
| created_at   | Timestamp of creation                |
| updated_at   | Timestamp of last update             |

Role-Permission Assignments:

| id  | permission_id (name)      | role_id (name) |
|-----|---------------------------|----------------|
| 1   | 2 (assign_roles)           | 1 (admin)      |
| 2   | 6 (delete_article)         | 1 (admin)      |
| 3   | 5 (publish_article)        | 1 (admin)      |
| 4   | 1 (view_all_users)         | 1 (admin)      |
| 5   | 5 (publish_article)        | 2 (editor)     |
| 6   | 3 (create_article)         | 3 (author)     |
| 7   | 4 (edit_own_article)       | 3 (author)     |
| 8   | 8 (view_own_articles)      | 3 (author)     |

role_user table:

| Column     | Description                  |
|------------|------------------------------|
| id         | Unique identifier             |
| user_id    | Foreign key to users.id       |
| role_id    | Foreign key to roles.id       |
| created_at | Timestamp of creation         |
| updated_at | Timestamp of last update      |

User-Role Assignments:

| id  | user_id | role_id (name) |
|-----|---------|----------------|
| 1   | 1       | 1 (admin)      |
| 2   | 2       | 3 (author)     |
| 3   | 3       | 3 (author)     |

## Role Based Access Control Truth Table
| Role   | Permissions                                              |
|--------|----------------------------------------------------------|
| Admin  | assign_roles, delete_article, publish_article, view_all_users |
| Editor | publish_article                                          |
| Author | create_article, edit_own_article, view_own_articles      |

## Proof of Concept: Test Request Payload and Responses
### Example 1: Check if Admin can assign roles
### Request: POST /api/users/role/update
```json
{
  "user_id": 2,
  "role": "author"
}
```
### Response: 
```json
{
    "success": true,
    "code": 200,
    "message": "User fetched successfully",
    "data": {
        "id": 3,
        "name": "author",
        "email": "author@example.com",
        "roles": [
            {
                "id": 3,
                "name": "author"
            }
        ],
        "permissions": [
            {
                "id": 3,
                "name": "create_article"
            },
            {
                "id": 4,
                "name": "edit_own_article"
            },
            {
                "id": 8,
                "name": "view_own_articles"
            }
        ]
    },
    "errors": null
}

```

### Example 1: Author creating an article
### Request: POST /api/articles

```json
{
    "title" : "test",
    "body" : "test tat"

}

```
### Response:
```json
{
    "success": true,
    "code": 200,
    "message": "Article fetched successfully",
    "data": [
        {
            "id": 1,
            "title": "test",
            "body": "test tat",
            "published_at": null,
            "created_at": "2025-08-08T21:08:13.000000Z",
            "updated_at": "2025-08-08T21:08:13.000000Z",
            "user": {
                "id": 2,
                "name": "Ashad1",
                "email": "ashad1@example.com"
            }
        }
    ],
    "errors": null
}

```

### Example 3: Author can update an article
### Request: PUT /api/articles/update/1
```json
{
  "title": "ok",
  "body": "ok"
}

```

### Response:
```json
{
    "success": true,
    "code": 200,
    "message": "Article fetched successfully",
    "data": [
        {
            "id": 1,
            "title": "ok",
            "body": "ok",
            "published_at": null,
            "created_at": "2025-08-11T06:18:35.000000Z",
            "updated_at": "2025-08-11T06:23:10.000000Z",
            "user": {
                "id": 2,
                "name": "Ashad1",
                "email": "ashad1@example.com"
            }
        }
    ],
    "errors": null
}

```
## Summary
- Users are assigned roles through the `role_user` table.
- Roles define permissions via the `permission_role` table.
- API endpoints enforce access control based on these roles and permissions.
