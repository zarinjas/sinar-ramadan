@php
    $index = 1;
@endphp
<div>
    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="m-0 fw-light h5 text-black">Galeri Video</h4>
            <button type="button" class="btn btn-link d-flex align-items-center text-decoration-none" wire:click.prevent="add({{ $video_i }})">
                <x-orchid-icon 
                    path="plus"
                    class="me-2"  
                    width="1em" 
                    height="1em" />
                    Add More
            </button>
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Video ID (eg: https://www.youtube.com/watch?v={video_id})</th>
                <th scope="col" width="100">Custom Thumbnail</th>
                <th scope="col" width="100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($inputs as $key => $value)
                <tr height="80">
                <td class="text-start text-muted" colspan="1">{{ $index }}<input wire:model.defer="videos.{{ $key }}.id" name="videos[{{ $key }}][id]" type="hidden"></td>
                <td class="text-start" colspan="1">
                    <input wire:model.defer="videos.{{ $key }}.video_name" name="videos[{{ $key }}][video_name]" type="text" class="form-control @error('videos.'. $key . '.video_name') is-invalid @enderror" placeholder="Video Title">
                    @error('videos.'. $key . '.video_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <td class="text-start" colspan="1">
                    <input wire:model.defer="videos.{{ $key }}.youtube_id" name="videos[{{ $key }}][youtube_id]" type="text" class="form-control @error('videos.'. $key . '.youtube_id') is-invalid @enderror" placeholder="Youtube Video ID">
                    @error('videos.'. $key . '.youtube_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
                <td>
                    <div class="form-group">
                        <div data-controller="picture" data-picture-value="" data-picture-storage="public"
                            data-picture-target="id" data-picture-url="" data-picture-max-file-size="512"
                            data-picture-accepted-files="image/*" data-picture-groups="">
                            <div class="picture-actions">
                                <div class="fields-picture-container">
                                    <img src="#"
                                        class="picture-preview img-fluid img-full mb-2 border" alt="">
                                </div>
                                <div class="btn-group">
                                    <label class="btn btn-default m-0">
                                        <x-orchid-icon 
                                        path="picture"
                                        class="me-2" 
                                        width="1em" 
                                        height="1em" />
                                        Browse
                                        <input type="file" accept="image/*" data-target="picture.upload"
                                            data-action="change->picture#upload" class="d-none">
                                    </label>
                                    <button type="button" class="btn btn-outline-danger picture-remove"
                                        data-action="picture#clear">Remove</button>
                                </div>

                                <input type="file" accept="image/*" class="d-none">
                            </div>

                            <input class="picture-path d-none" type="text" data-target="picture.source" target="id"
                                name="videos[{{ $key }}][video_thumbnail]" id="">
                        </div>
                    
                        </div>
                </td>
                <td class="text-start" colspan="1">
                    <div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-link" wire:click.prevent="remove({{ $key }})">
                                <x-orchid-icon 
                                    path="trash"
                                    class="me-2" 
                                    width="1em" 
                                    height="1em" />
                                    Remove
                            </button>
                        </div>
                    </div>
                </td>
                </tr>
                @php
                    $index++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>

