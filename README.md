

APIs:
 a. POST /member       Create member (name, website_url)
 b. POST /friendship/  Create friendship (member_id, friend_id)
 c. GET  /members      List all members  (id, name, website_short_url, num_of_friends)
 d. GET /member/{id}   List member (id, name, website_url, website_short_url, website_headings, link_to_friends_pages)
 e. GET /member/{id}/experts_for/{topic} - A's profile where C is expert in {topic} and A is not friend of C


Database schema:

 1. members:

 id
 name
 status
 created_at
 updated_at

 2. websites:

 id
 member_id
 url
 short_url
 created_at
 updated_at

 3. website_headings:

 id
 website_id
 header_type
 header_content
 created_at
 updated_at


 4. friendships:

 id
 member_id
 friend_id
 status
 created_at
 updated_at


Analysis:
1. Studied and analyzed the problem
2. Noted down entities, and their relations in form of database
3. Identified possible APIs to be developed

Development:
1. Downloaded laravel framework boilerplate
2. Write down database migrations, and run
3. Finalize API flow, and create project structure / folders organization
4. Develop Models / Entity files (I was lazy, so I used open source project to create it from database schema.)
5. Develop Create Member API
6. Develop Create Friendship API
7. Develop Get members API
8. Develop Get member API
9. Developed Get expert members for topic and not friend
