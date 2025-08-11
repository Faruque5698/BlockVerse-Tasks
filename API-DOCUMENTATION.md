# API Documentation
## 1. Authentication
### POST `/api/register`
**Description:**
User Registration

**Request Body:**
```json
{
    "name":"author",
    "email":"author@example.com",
    "password":"password",
    "password_confirmation":"password"
}
```

**Response:**

```json
{
    "success": true,
    "code": 200,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 3,
            "name": "author",
            "email": "author@example.com",
            "roles": [],
            "permissions": []
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTI0MDIxMDBmOGNjNTA1N2I5ODc4YmNmNzI2NGJkYzViMmFhMDcxOTBjZTRiN2EzMjE4ZmZjMGUwNzBjYmIyNDIxODZjODM3MWE0MDQyNjMiLCJpYXQiOjE3NTQ4OTM4OTkuNDM1ODgzLCJuYmYiOjE3NTQ4OTM4OTkuNDM1ODg2LCJleHAiOjE3ODY0Mjk4OTkuMzkwOTc4LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.f03jr2LcjQJhTKJh-80gipjmQ-nIS8CrMxd79xnAPR1bWUtsQiaGDrfLy-zLAdePKNIgMT-t6Cy5xKoxR55q44GjOTWAHU5haw-R9IvB2lsfGouFECDjuXu0bQFDTRG8hAUA_6BwEBXDIeocf-tPvlEvj9dh1X8SXFxAd3cCdhAydjXAPekxwE9AES_sM0fNAaJ-3ooTbx7N_IYtm-zyREL__1qlOdYmHBq6SQ8FgasaoayOA_qttOFO7DyWuxP37bIavz12B8-BNI7B9fPrXTt3RnfWPDzFuSVi0fL3wRfmXs-26VXemyiXSfiWJ-3gmK_GfwGP7SVVo7HZxmXNzkDAcwdgFeOPLgH4SNKjOAZ88pQMNffYTkXaDj1eex33fWoNJh5sVJsf5JNCWfhntS4s74U0GaYWQne2gyN9HrZ2jGMB1Kn5amjs4TMsWCl7EOhxacc9g-0HtLddbyUm2pAQTr-Xxhk4yncwvSefX8LZ0qvxln6F5J5mrUH3LHO980DoUZKb0AV9IxFjXV_CecAUrXWrn_r7U8-HDTR2Ps688HmPwB_T9uQyAMtdljTTN1Yh86_XDo9bUyoIB4-x4ZVK8mWAprh_dxHzHM2VrXKbIBv181tNpj2bJI8MIrqWDLAebP66FlGO7MBfgpeMG6_tBnHtWyUDUjBH-EfL7gY",
        "token_type": "Bearer"
    },
    "errors": null
}
```


### POST `/api/login`
**Description:**
User login

**Request Body:**
```json
{
    "email":"admin@example.com",
    "password":"password"
}
```

**Response:**

```json
{
    "success": true,
    "code": 200,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@example.com",
            "roles": [
                {
                    "id": 1,
                    "name": "admin"
                }
            ],
            "permissions": [
                {
                    "id": 2,
                    "name": "assign_roles"
                },
                {
                    "id": 6,
                    "name": "delete_article"
                },
                {
                    "id": 5,
                    "name": "publish_article"
                },
                {
                    "id": 1,
                    "name": "view_all_users"
                }
            ]
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIwMTk4OGFiNy1kZTQ4LTcyNDMtYjkwNC0xN2RjYTZkNjY4YmQiLCJqdGkiOiJhMGMzNjk3M2MzYjU1MzE0YmVkOTY3Yjc0MGIyZmYxYzI2NGU2YjhlZTMxYTM1MDg4ZGJmNDQ4YmNlYTBhMTM1NGRiMzFkMTc1ZTE2YzM4MCIsImlhdCI6MTc1NDY3Mzk2OC4xNzYzNDgsIm5iZiI6MTc1NDY3Mzk2OC4xNzYzNSwiZXhwIjoxNzcwNTcxNTY4LjExNzA1Mywic3ViIjoiMSIsInNjb3BlcyI6W119.n1piLwrNYdZMKvY0dZ9r726fqio8qb3cbHOvumEcrkMUmHskTo1RJNlSv5tTbQtePP-jSgQKQwfkF2m2NItcpXeAptfMtlsWbxc5QEekqdDoRa9qUXOuM46EwCFlTusL080eg9zGCmhfKqwNCThmgu9nvvAJkljzCmv0jWqIiVm4WzziIcvWRqbkUsc5PgQn76wtPai0qeQb8mBTJPrGDWZOHqsswcYjfrG8-YWTh4n6ruUBZLiOn-iNmIGuUFGc6BDH9egxmrp_4GZUIcWBNzdpzM7KtECHN4j0cW_oZ59oVoe2qkyORV2CLmlRfngQhwXlffuD0QzgT-UTdRzfvdyBQ6CKjY6aA6MaZT5XRIy43tBwAFUBmjbS81aN5SOEaqn3Qzf2JXIVDLUMsP_kVTOVqt94872HklHAanUvcgmvvLcZx-OOu3iawvFFzlllujbm_jZ29XHLkIZMmgEiD7UHgCYIiaku_n7o9G-OzqfKUsa1epmsADcYFlok4_JeUxTgkC1xMG3Ht1fGeLQA2SX7gMSRddK-DgAv0fsIsrMfWkJnXvxkvLIsoezecmADUwZT-mq8wOC4BQht2-s4R3I6D-CQ4Cr4-Z9VFIJa2xEDSHQLSyS68dFKDNzigQZU4bJj2sV4ecNbdbLchW7w5YWR11jBh_eFOzLqhwrKinM",
        "token_type": "Bearer"
    },
    "errors": null
}
```

### GET `/api/profile`
**Description:**
User Profile

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Response:**

```json
{
    "success": true,
    "code": 200,
    "message": "User fetched successfully",
    "data": {
        "id": 1,
        "name": "Admin User",
        "email": "admin@example.com",
        "roles": [
            {
                "id": 1,
                "name": "admin"
            }
        ],
        "permissions": [
            {
                "id": 2,
                "name": "assign_roles"
            },
            {
                "id": 6,
                "name": "delete_article"
            },
            {
                "id": 5,
                "name": "publish_article"
            },
            {
                "id": 1,
                "name": "view_all_users"
            }
        ]
    },
    "errors": null
}
```

### POST `/api/logout`
**Description:**
User logout

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Response:**

```json
{
    "success": true,
    "code": 200,
    "message": "Logged out successfully",
    "data": null,
    "errors": null
}
```


## 2. User Manage

### GET `/api/users`
**Description:**
View all users

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Response**

```json
{
    "success": true,
    "code": 200,
    "message": "Users fetched successfully",
    "data": [
        {
            "id": 1,
            "name": "Admin User",
            "email": "admin@example.com",
            "roles": [
                {
                    "id": 1,
                    "name": "admin"
                }
            ],
            "permissions": [
                {
                    "id": 2,
                    "name": "assign_roles"
                },
                {
                    "id": 6,
                    "name": "delete_article"
                },
                {
                    "id": 5,
                    "name": "publish_article"
                },
                {
                    "id": 1,
                    "name": "view_all_users"
                }
            ]
        },
        {
            "id": 2,
            "name": "Ashad1",
            "email": "ashad1@example.com",
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
        {
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
        }
    ],
    "errors": null
}
```

### POST `/api/users/role/update/`
**Description:**
User Role assign

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Request Body**
```json
{
    "role":"author", //author, admin, editor
    "user_id":3
}
```

**Response**

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

## 3. Article Manage

### GET `/api/articles`
**Description:**
Article List

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Response**

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

### POST `/api/articles`
**Description:**
Article create

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Request Body**
```json
{
    "title" : "test",
    "body" : "test tat"

}
```

**Response**

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

### PUT `/api/articles/update/{id}`
**Description:**
Article create

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Request Body**
```json
{
    "title" : "ok",
    "body" : "ok"

}
```

**Response**

```json
{
    "success": true,
    "code": 200,
    "message": "Article update successfully",
    "data": [
        {
            "id": 1,
            "title": "ok",
            "body": "ok",
            "published_at": "2025-08-11 07:20:08",
            "created_at": "2025-08-11T06:18:35.000000Z",
            "updated_at": "2025-08-11T07:20:08.000000Z",
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

### PUT `/api/articles/update/{id}`
**Description:**
Article create

**Headers:**
```http
Authorization: Bearer {your_access_token}
```

**Request Body**
```json
{
    "title" : "ok",
    "body" : "ok"

}
```

**Response**

```json
{
    "success": true,
    "code": 200,
    "message": "Article update successfully",
    "data": [
        {
            "id": 1,
            "title": "ok",
            "body": "ok",
            "published_at": "2025-08-11 07:20:08",
            "created_at": "2025-08-11T06:18:35.000000Z",
            "updated_at": "2025-08-11T07:20:08.000000Z",
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


### GET `/api/articles/publish/{id}`
**Description:**
Article publish

**Headers:**
```http
Authorization: Bearer {your_access_token}
```


**Response**

```json
{
    "success": true,
    "code": 200,
    "message": "Article published successfully",
    "data": null,
    "errors": null
}
```

### DELETE `/api/articles/{id}`
**Description:**
Article delete

**Headers:**
```http
Authorization: Bearer {your_access_token}
```


**Response**

```json
{
    "success": true,
    "code": 200,
    "message": "Article deleted successfully",
    "data": null,
    "errors": null
}
```


### DELETE `/api/articles/own`
**Description:**
Own Article 

**Headers:**
```http
Authorization: Bearer {your_access_token}
```


**Response**

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
            "published_at": "2025-08-11 07:20:08",
            "created_at": "2025-08-11T06:18:35.000000Z",
            "updated_at": "2025-08-11T07:20:08.000000Z",
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


