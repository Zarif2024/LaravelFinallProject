<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            width: 90%;
            max-width: 500px;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <button onclick="showCreatePopup()" class="bg-blue-500 text-white py-2 px-4 rounded my-2">Create Post</button>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-300">
                        <th class="px-4 py-2 border-b">Title</th>
                        <th class="px-4 py-2 border-b">Content</th>
                        <th class="px-4 py-2 border-b flex justify-end mr-8">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td class="px-4 py-2 border-b text-center">{{ $post->title }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $post->content }}</td>
                        <td class="px-4 py-2 border-b flex justify-end">
                            <button 
                            onclick="showEditPopup('{{ $post->id }}', '{{ $post->title }}', '{{ $post->content }}')" 
                            class="bg-blue-500 text-white py-1 px-3 rounded mr-2">Edit</button>
                            <form id="deleteForm-{{ $post->id }}" action="/delete-post/{{ $post->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $post->id }})" class="bg-red-500 text-white py-1 px-3 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popup for creating a post -->
    <div id="createPopup" class="popup bg-white p-4 rounded shadow-lg">
        <form id="createPostForm" method="POST" action="/createPost">
            @csrf
            <div class="mb-4">
                <h3 class="font-bold py-4">Create Post</h3>
                <label for="createTitle" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="createTitle" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Title">
            </div>
            <div class="mb-4">
                <label for="createContent" class="block text-gray-700">Content</label>
                <input type="text" name="content" id="createContent" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Content">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">Submit</button>
                <button type="button" onclick="closePopup('createPopup')" class="bg-gray-300 text-gray-700 py-2 px-4 rounded">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Popup for editing a post -->
    <div id="editPopup" class="popup bg-white p-4 rounded shadow-lg">
        <form id="editPostForm" method="POST" action="">
            @csrf
            @method('PUT')
            <input type="hidden" name="post_id" id="editPostId">
            <div class="mb-4">
                <h3 class="font-bold py-4">Edit Post</h3>
                <label for="editTitle" class="block text-gray-700">Title</label>
                <input type="text" name="title" id="editTitle" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Title">
            </div>
            <div class="mb-4">
                <label for="editContent" class="block text-gray-700">Content</label>
                <input type="text" name="content" id="editContent" class="w-full p-2 border border-gray-300 rounded mt-1" placeholder="Content">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">Submit</button>
                <button type="button" onclick="closePopup('editPopup')" class="bg-gray-300 text-gray-700 py-2 px-4 rounded">Cancel</button>
            </div>
        </form>
    </div>

    <div id="overlay" class="overlay" onclick="closePopup('createPopup'); closePopup('editPopup')"></div>

    <script>
        function showCreatePopup() {
            document.getElementById('createPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function showEditPopup(id, title, content) {
            document.getElementById('editPostId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editContent').value = content;
            document.getElementById('editPostForm').action = `/editPost/${id}`;
            document.getElementById('editPopup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                document.getElementById('deleteForm-' + postId).submit();
            }
        }
    </script>
</body>
</html>
