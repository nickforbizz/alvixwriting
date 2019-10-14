
@if ($code == "errorsArray")

    <li class="list-group-item">${ element[0]}</li>

@elseif ($code == "uploadassg")

    <li class="list-group-item">${ element[0]}</li>
@elseif ($code == "DownloadFiles")

    <li class="list-group-item text-success"> <b>Name</b>    ${ element.name}
        <span class="badge" style="padding: 7px;background-color: #ece0e0; color: #000;cursor: pointer">
            <strong onclick="download(${element.id})">Download</strong>
        </span>
    </li>

@else

@endif

