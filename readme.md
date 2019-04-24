# Video Library REST API by Laravel
All the endpoint of this REST API is created with Laravel. It takes JSON data as input and returns JSON data as output.  Check below for info about endpoints and input data format examples.

## API Endpoints

 - **/api/users , POST , Create a user**
 , Input Data Format: `{
    "name": "Saqlain",
    "photoUrl": "asdad",
    "email": "ebnbs@gmail.com"
}`
 - **/api/users , GET, Read all users**
 - **/api/users/{id} , GET, Read a user**
 - **/api/users/{id} , PUT, Update a user**
 , Input Data Format : `{
    "name": "Saqlain",
    "photoUrl": "asdad",
    "email": "ebnbs@gmail.com"
}`

 - **/api/users/{id} , DELETE, Delete a user**
  - **/api/videos , POST , Create a video**
 , Input Data Format: `{
    "title": "Spider-Man",
    "url": "asdad",
    "description": "asdasdad",
    "thumbnailUrl": "ebnbsasda"
}`
   
  - **/api/videos , GET , Read all video**
   
  - **/api/videos/{id} , GET , Read a video**
   
 -  **/api/videos/{id} , PUT , Update a video**
 , Input Data Format: `{
	"title": "Spider-Man",
    "url": "asdad",
    "description": "asdasdad",
    "thumbnailUrl": "ebnbsasda"
}`
   
 -  **/api/videos/{id} , DELETE , Delete a video**
   
     
   
-   **/api/videos?sortBy=name , GET , Fetch all videos ordered by title
   name**
   
 -  **/api/videos?sortBy=like count , GET , Fetch all videos ordered by
   total likes on a video**
   
  - **/api/videos?sortBy=updated time , GET , Fetch all videos ordered by
   title update time**
   
     
   
  - **/api/videos/{id}/like , POST , Like/Unlike a video**
  , Input Data Format: `{
    "user": "3" //Here user is the user_id of the user who is liking
}`
   
   - **/api/videos/{id}/likes/count , GET , Read like count of a video**
   
   - **/api/videos/likes/count , GET , Read like count of all the video**
   
     
   
   - **/api/videos/{id}/comment , POST , Comment on a video**
   , Input Data Format: `{
	"user":"3",
	"comment":"This is another comment on the video"   //Here user is the user_id of the user who is commenting
}`
```