<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSW</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fake-focus {
            outline: 1px solid rgba(100,255,255,0.8);
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-900">
    <div class="flex w-8/12 h-[800px]">
        <div class="flex flex-col bg-zinc-400 w-4/12">
            <div class="flex basis-6/12">
                <img src="assets/images/psw.png" alt="" class="h-3/4 w-full">
            </div>
            <div class="flex flex-col justify-end items-center basis-6/12 p-4">
                <p class="text-red-50 text-lg font-bold">Alberto Cancela</p>
                <div class="flex justify-center gap-2 mt-2 text-gray-900">
                    <a target="_blank" href="https://github.com/AlbertoCancela" class="text-xl"><i class="bi bi-github"></i></a>
                    <a target="_blank" href="https://www.linkedin.com/in/albertocancela/" class="text-xl"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-sky-950 w-8/12">
            <div class="flex bg-zinc-300 basis-32 justify-center items-center gap-4 text-gray-500 text-xl font-bold">
                <button name="crudSelection" onclick="crudSelection('SEARCH',1,'gray')" class="w-36 h-12 border border-2 border-gray-400 rounded-md hover:bg-gray-400 text-center"> Search </button>
                <button name="crudSelection" onclick="crudSelection('INSERT',2,'green')" class="w-36 h-12 border border-2 border-green-400 rounded-md hover:bg-green-400 text-center"> Insert </button>
                <button name="crudSelection" onclick="crudSelection('UPDATE',2,'sky')" class="w-36 h-12 border border-2 border-blue-400 rounded-md hover:bg-blue-400 text-center"> Update </button>
                <button name="crudSelection" onclick="crudSelection('DELETE',1,'red')" class="w-36 h-12 border border-2 border-red-400 rounded-md hover:bg-red-400 text-center"> Delete </button>
            </div>
            <div class="flex justify-center basis-full">
                <form id="crudForm" class="flex flex-col items-center justify-center text-gray-200 w-10/12 h-full  p-6 text-[1.2em]">
                    <div class="flex flex-1 w-full">
                        <div class="flex-1"><p class="text-[1.2em] w-8/12">Fill in the fields to <b id="crudState">SEARCH</b> a user</p></div>
                        <div class="flex-1 flex flex-col">
                            <label for="userID">User ID</label>
                            <input id="userID" type="text" class="R w-10/12 bg-sky-900 h-12 text-gray-300" required>
                        </div>
                    </div>
                    <div class="flex flex-1 w-full">
                        <div class="flex-1 flex flex-col">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="CUD w-10/12 bg-sky-900 h-12 text-gray-300" required>
                        </div>                        
                        <div class="flex-1 flex flex-col">
                            <label for="lastName">Last Name</label>
                            <input id="lastName" type="text" class="CUD w-10/12 bg-sky-900 h-12 text-gray-300" required>
                        </div>
                    </div>
                    <div class="flex flex-1 w-full">
                        <div class="flex-1 flex flex-col">
                            <label for="phoneNumber">Phone number</label>
                            <input id="phoneNumber" type="text" class="CUD w-10/12 bg-sky-900 h-12 text-gray-300 appearance-none" required>
                        </div>
                        <div class="flex-1 flex flex-col">
                            <label for="email">Email</label>
                            <input id="email" type="text" class="CUD w-10/12 bg-sky-900 h-12 text-gray-300" required>
                        </div>

                    </div>
                    <div class="flex flex-1 w-full justify-center">
                        <div class="flex-1 flex flex-col">
                            <label for="additionalData">Additional Information</label>
                            <textarea id="additionalData" type="text" class="CUD w-11/12 bg-sky-900 h-full text-gray-300" required></textarea>
                        </div>
                    </div>
                    <div class="flex flex-1 w-full mt-5">
                        <button onclick="" class="w-11/12 h-10 border border-green-500 rounded-md"> confirm </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
    <script src="src/controller/js/validations.js"></script>
    <script src="src/controller/js/submitHandler.js"></script>
    <script src="src/controller/js/crudSelection.js"></script>
</html>
