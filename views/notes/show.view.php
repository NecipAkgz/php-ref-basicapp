<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <a href="/notes" class='text-blue-900 hover:underline font-bold'>Go back notes</a>
        </p>
        <p>
            <?= htmlspecialchars($note['body']) ?>
        </p>

        <footer class="mt-6">
            <a href="note/edit?id=<?= $note['id'] ?>" class="rounded text-white bg-gray-500 border px-4 py-1 hover:underline">Edit</a>
        </footer>

        <!--        <form class="mt-6" method="POST">-->
        <!--            <input type="hidden" name="_method" value="DELETE">-->
        <!--            <input type="hidden" name="id" value="--><?php //= $note['id'] ?><!--"">-->
        <!--            <button class="text-sm text-red-500">Delete</button>-->
        <!--        </form>-->
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
