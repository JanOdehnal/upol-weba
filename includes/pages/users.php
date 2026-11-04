<section class="mt-5">
    <h6>You are logged in as a <?php echo $_SESSION['email']; ?></h6>
    <h2>Table example</h2>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td colspan="2">Larry the Bird</td>
        <td>@twitter</td>
        </tr>
        <tr>
        <th scope="row">4</th>
        <td>John</td>
        <td>Doe</td>
        <td>@johndoe</td>
        </tr>
    </tbody>

    </table>

    <div id="plaggination">
    <button type="button">Previous</button>
    <button type="button">The x. of y</button>
    <button type="button">Next</button>
    </div>
</section>