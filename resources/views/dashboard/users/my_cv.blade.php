@extends('layouts.defaultclient')
@section('stylesheet')

@endsection
@section('content')

    <style>
        .delete {
            border: none;
            background: transparent;
        }

        .m-btn {
            border-radius: 20px;
            background: green;
            color: #fff;
            width: auto;
        }

    </style>
    <div class="site-section bg-light ">
        <div class="container">
            <div class="row  pt-5 px-2 mt-4">
                <div class="col-lg-4 col-md-4 col-sm-12 top2 pt-5">
                    <div class="bg-white rounded shadow">
                        <div class="text-center">
                            <img src="{{ asset(Storage::url($user->avatar)) }} " class="rounded-circle p-2" alt="Image"
                                style="width:159px; height:159px">
                            <img src=" {{ asset('asset/images/edit.png') }} " data-toggle="modal" data-target="#editimage"
                                alt="" class="cursor-pointer edit-img" width="4.5%" height="2.5%">
                        </div>
                        <ul>
                            <li class="d-md-flex d-block">
                                <h5 class="py-2 px-4 font-weight-bold">
                                    {{ app()->getLocale() == 'ar' ? $user->ar_name . ' ' . $user->ar_last_name : $user->name . ' ' . $user->last_name }}
                                </h5>
                            </li>
                        </ul>
                        <table class="table table-borderless mx-3">
                            <tr>
                                <th width="25%">{{ __('Country') }} </th>
                                <td>
                                  {{ app()->getLocale() == 'ar' ? $user->country->ar_name ?? "" . '-' . $user->city->ar_name ?? "" : $user->country->name ?? "" . ' - ' . $user->city->name ?? "" }}
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Education') }} </th>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#educationinfo">
                                        {{ ($user->role_id == null ? __('Add Education info') : app()->getLocale() == 'ar') ? $user->role->ar_name ?? '' : $user->role->name ?? '' }}
                                        @foreach ($user->educations as $key => $education)
                                            @if ($user->educations->contains($education))
                                                <br> {{ $key + 1 }} -
                                                {{ app()->getLocale() == 'ar' ? $education->ar_qualification . ' - ' . $education['special']['ar_name'] ?? '' : $education->qualification . ' - ' . $education['special']['name'] ?? '' }}
                                            @endif
                                        @endforeach
                                        {{-- @foreach ($user->educations as $education) {{$education['sub_special']['ar_name']}} @endforeach --}}
                                        {{-- {{(app()->getLocale() == 'ar') ? $user->sub_special->ar_name ?? '':$user->sub_special->name ?? ''}} --}}
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Experience') }} </th>
                                @if (is_null($expert))
                                    <td><a href="" data-toggle="modal" data-target="#addexperience">
                                            {{ __('Add Experience') }}</a></td>
                                @else
                                    <td><a href="" data-toggle="modal"
                                            data-target="#addexperience">{{ abs($expert->end_year - $expert->start_year) }}
                                            {{ __('Years') }} {{ abs($expert->end_month - $expert->start_month) }}
                                            {{ __('Months') }}</a></td>
                                @endif
                            </tr>
                        </table>
                        <div class="text-center p-3">
                            <a href="{{ route('pdf.download', $user->id) }}"
                                id="download-attachment"
                                class="btn btn-outline-primary px-3  font-weight-bold">{{ __('Save as PDF') }} </a>
                        </div>
                        <div class="p-3">
                            <hr>
                            <p><span class="text-muted"> {{ __('Last updated CV:') }} </span> {{ $user->updated_at }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="top1">
                        <!--comlete your cv-->
                        <div
                            class="{{ number_format($count, '0', '.', '') >= 80 ? 'border-success' : 'border-danger' }} my-3 text-center bg-white d-block d-md-flex rounded border-right sec1">
                            <div class="p-3">
                                <span
                                    class="{{ number_format($count, '0', '.', '') >= 80 ? 'text-success' : 'text-danger' }} display-4">{{ number_format($count, '0', '.', '') }}%</span>
                            </div>
                            <p class="align-self-center">
                                {{ __('Complete your CV by 80% to be the highlights 10% of the most visible users') }}</p>
                        </div>

                        <!--------------- user info // cv info ----------------->
                        <div class="bg-white mb-3 rounded">
                            <div class="card ">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold"> {{ __('Personal Information') }} </h5>
                                    <a href="#personalinfo" data-toggle="modal"><img
                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th scope="col">{{ __('First Name') }}</th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_name : $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('Last Name') }}</th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_last_name : $user->last_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('Specialization') }}</th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->special->ar_name ?? '' : $user->special->name ?? '' }}
                                            </td>
                                        </tr>
                                        <th scope="row">{{ __('Job Level') }}</th>
                                        <td>{{ $user->level ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('Gender') }}</th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_gender : $user->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('Place of Birth') }}</th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_brith : $user->brith }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('Birth Date') }}</th>
                                            <td>{{ $user->birthdate }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="col"> {{ __('Current Housing') }} </th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->country->ar_name ?? '' : $user->country->name ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col"> {{ __('Current City') }} </th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->city->ar_name ?? '' : $user->city->name ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col"> {{ __('Social Status') }} </th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_social_status : $user->social_status }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col"> {{ __('Religion') }} </th>
                                            <td>{{ app()->getLocale() == 'ar' ? $user->ar_religion : $user->religion }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ __('Identity No') }} </th>
                                            <td>{{ $user->idint_1 . ' - ' . $user->idint_2 }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white mb-3 rounded">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold"> {{ __('Contact Information') }} </h5>
                                    <a href="" data-toggle="modal" data-target="#contact"><img
                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th scope="col"> {{ __('Phone Number') }} </th>
                                            <td>{{ $user->phone_key . '' . $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> {{ __('E-Mail Address') }} </th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- Education info -->
                        <div class="bg-white mb-3 rounded" id="app">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="m-0 font-weight-bold"> {{ __('Education Information') }} </h5>
                                    <a href="" data-toggle="modal" data-target="#addeducation"><img
                                            src=" {{ asset('asset/images/pluss.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="">

                                    @foreach ($user->educations as $education)

                                        @if ($user->educations->contains($education))
                                            @if (app()->getLocale() == 'ar')
                                                <div class="card-body d-flex justify-content-between">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th scope="col"> {{ __('Qualification') }} </th>
                                                            <td> <span>{{ $education['special']['ar_name'] ?? '' }}</span>
                                                                - <span>{{ $user->role->ar_name }}</span> -
                                                                <span>{{ $education->ar_qualification }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('University') }}</th>
                                                            <td> {{ $education->ar_university }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Area') }}</th>
                                                            <td><span>{{ $user->country->ar_name }}</span>-
                                                                <span>{{ $user->city->ar_name }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Graduation Date') }}</th>
                                                            <td>{{ $education->grade_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Average') }}</th>
                                                            <td>{{ $education->grade }}</td>
                                                        </tr>
                                                    </table>
                                                    <a
                                                        href="{{ route('users.edit', [app()->getLocale(), $education->id]) }}"><img
                                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                                    <form
                                                        action="{{ route('users.destroy', [app()->getLocale(), $education->id]) }}"
                                                        method='post'>
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="select" value="edu">
                                                        <button type="submit" class="delete"><img
                                                                src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                                class="p-1 align-left float-left   cursor-pointer"></button>
                                                    </form>
                                                </div>

                                            @else

                                                <div class="card-body d-flex justify-content-between">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th scope="col"> {{ __('Qualification') }} </th>
                                                            <td><span>{{ $user->role->name }}</span> -
                                                                <span>{{ $education['special']['name'] ?? '' }}</span> -
                                                                <span>{{ $education->qualification }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('University Of') }}</th>
                                                            <td>{{ $education->university }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Area') }}</th>
                                                            <td>{{ $user->city->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Date Of graduation') }}</th>
                                                            <td>{{ $education->grade_date }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Rate') }}</th>
                                                            <td>{{ $education->grade }}</td>
                                                        </tr>
                                                    </table>
                                                    <a
                                                        href="{{ route('users.edit', [app()->getLocale(), $education->id]) }}"><img
                                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                                    <form
                                                        action="{{ route('users.destroy', [app()->getLocale(), $education->id]) }}"
                                                        method='post'>
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="select" value="edu">
                                                        <button type="submit" class="delete"><img
                                                                src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                                class="p-1 align-left float-left   cursor-pointer"></button>
                                                    </form>
                                                </div>

                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!-- language info -->
                        <div class="bg-white mb-3 rounded">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold">{{ __('Languages') }}</h5>
                                    <a href="#addlanguage" data-toggle="modal"> <img
                                            src=" {{ asset('asset/images/pluss.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="">
                                    @foreach ($user->languages as $lang)

                                        @if (app()->getLocale() == 'ar')

                                            <div class="card-body d-flex justify-content-between">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th scope="col"> {{ __('Language') }} </th>
                                                        <td>{{ $lang->ar_language }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col"> {{ __('Language Level') }} </th>
                                                        <td>{{ $lang->ar_language_level }} </td>
                                                    </tr>

                                                </table>
                                                <a href=" {{ route('lang.edit', [app()->getLocale(), $lang->id]) }} "><img
                                                        src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                        class="p-1 align-left float-left   cursor-pointer"></a>
                                                <form
                                                    action="{{ route('users.destroy', [app()->getLocale(), $lang->id]) }}"
                                                    method='post'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="select" value="lang">
                                                    <button type="submit" class="delete"><img
                                                            src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="card-body d-flex justify-content-between">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th scope="col"> {{ __('Language') }} </th>
                                                        <td> {{ $lang->language }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col"> {{ __('Language Level') }} </th>
                                                        <td>{{ $lang->language_level }}</td>
                                                    </tr>

                                                </table>
                                                <a href=" {{ route('lang.edit', [app()->getLocale(), $lang->id]) }} "><img
                                                        src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                        class="p-1 align-left float-left   cursor-pointer"></a>
                                                <form
                                                    action="{{ route('users.destroy', [app()->getLocale(), $lang->id]) }}"
                                                    method='post'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="select" value="lang">
                                                    <button type="submit" class="delete"><img
                                                            src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></button>
                                                </form>

                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>


                        <!-- Experience info -->
                        <div class="bg-white mb-3 rounded">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold">{{ __('Experience') }}</h5>
                                    <a href="#addexperience" data-toggle="modal"> <img
                                            src=" {{ asset('asset/images/pluss.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="">
                                    @foreach ($user->exps as $expert)

                                        @if ($user->exps->contains($expert))
                                            @if (app()->getLocale() == 'ar')
                                                <div class="card-body d-flex justify-content-between">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th scope="col"> {{ __('Experience years') }} </th>
                                                            <td><span>{{ $expert->end_year - $expert->start_year }}
                                                                    {{ __('Year') }}</span> &
                                                                <span>{{ abs($expert->end_month - $expert->start_month) }}
                                                                    {{ __('Month') }}</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Job Level') }}</th>
                                                            <td>{{ $expert->level ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Inistitute') }} </th>
                                                            <td><span>{{ $expert->company_name }}</span> -
                                                                <span>{{ $user->country->ar_name }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Description') }}</th>
                                                            <td>
                                                                <p></p>{{ Str::limit($expert->ar_summary, $limit = 40) }}
                                                                <p></p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="col">{{ __('File') }}</th>
                                                            <td>
                                                                <form method="POST"
                                                                    action="{{ route('user.download', $user->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name='f'
                                                                        value="{{ $expert->expert_pdf }}">
                                                                    <button class="delete m-btn"> {{ __('Download') }}
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                    <a
                                                        href=" {{ route('expert.edit', [app()->getLocale(), $expert->id]) }} "><img
                                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                                    <form method="POST"
                                                        action="{{ route('users.destroy', [app()->getLocale(), $expert->id]) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="select" value="expert_delete">
                                                        <button class="delete" type="submit"><img
                                                                src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                                class="p-1 align-left float-left   cursor-pointer"></button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="card-body d-flex justify-content-between">
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <th scope="col"> {{ 'Experience years' }} </th>
                                                            <td><span>{{ $expert->end_year - $expert->start_year }}
                                                                    {{ __('Years') }}</span> &
                                                                <span>{{ abs($expert->end_month - $expert->start_month) }}
                                                                </span> </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col"> {{ __('Job Level') }} </th>
                                                            <td> {{ $expert->level ?? '' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Inistitute') }} </th>
                                                            <td><span>{{ $user->country->name }}</span>-
                                                                <span>{{ $expert->company_name }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('Description') }}</th>
                                                            <td> {{ Str::limit($expert->summary, $limit = 40) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col">{{ __('File') }}</th>
                                                            <td>
                                                                <form method="POST"
                                                                    action="{{ route('user.download', $user->id) }}"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name='f'
                                                                        value="{{ $expert->expert_pdf }}">
                                                                    <button class="delete m-btn"> <i class="fa fa-download"
                                                                            aria-hidden="true"></i> Download </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <a
                                                        href=" {{ route('expert.edit', [app()->getLocale(), $expert->id]) }} "><img
                                                            src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                                    <form method="POST"
                                                        action="{{ route('users.destroy', [app()->getLocale(), $expert->id]) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="select" value="expert_delete">
                                                        <button class="delete" type="submit"><img
                                                                src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                                class="p-1 align-left float-left   cursor-pointer"></button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>


                        {{-- attachment --}}
                        <div class="bg-white mb-3 rounded">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold">{{ __('Attachment') }}</h5>
                                    <a href="#addAttch" data-toggle="modal"> <img
                                            src=" {{ asset('asset/images/pluss.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="">
                                    @foreach ($user->files as $file)

                                        <div class="card-body d-flex justify-content-between">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th scope="col"> {{ __('Name') }} </th>

                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('user.download', $user->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name='f' value="{{ $file->attch }}">
                                                            <input type="hidden" name='name'
                                                                value="{{ app()->getLocale() == 'ar' ? $file->ar_name : $file->name }}">
                                                            <button class="delete m-btn"> <i class="fa fa-download"
                                                                    aria-hidden="true"></i>
                                                                {{ app()->getLocale() == 'ar' ? $file->ar_name : $file->name }}</button>
                                                        </form>

                                                    </td>

                                                </tr>

                                            </table>
                                            <a href=" {{ route('attch.edit', [app()->getLocale(), $file->id]) }} "><img
                                                    src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                    class="p-1 align-left float-left   cursor-pointer"></a>
                                            <form method="POST"
                                                action="{{ route('users.destroy', [app()->getLocale(), $file->id]) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="select" value="attch_delete">
                                                <button class="delete" type="submit"><img
                                                        src=" {{ asset('asset/images/cross.png') }} " alt=""
                                                        class="p-1 align-left float-left   cursor-pointer"></button>
                                            </form>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        {{-- end attachment --}}

                        {{-- reference --}}
                        <div class="bg-white mb-3 rounded">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <h5 class="font-weight-bold">{{ __('References') }}</h5>
                                    <a href="#addRef" data-toggle="modal"> <img
                                            src=" {{ asset('asset/images/pluss.png') }} " alt=""
                                            class="p-1 align-left float-left   cursor-pointer"></a>
                                </div>
                                <div class="">
                                    @foreach ($user->references as $ref)

                                        <div class="card-body d-flex justify-content-between">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th scope="col"> {{ __('Name') }} </th>
                                                    <td> {{ app()->getLocale() == 'ar' ? $ref->ar_name : $ref->name }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="col"> {{ __('Email') }} </th>
                                                    <td> {{ $ref->email }} </td>
                                                </tr>

                                                <tr>
                                                    <th scope="col"> {{ __('Phone') }} </th>
                                                    <td>{{ $ref->phone }}</td>
                                                </tr>

                                            </table>
                                            <a href=" {{ route('ref.edit', [app()->getLocale(), $ref->id]) }} "><img
                                                    src=" {{ asset('asset/images/edit.png') }} " alt=""
                                                    class="p-1 align-left float-left   cursor-pointer"></a>
                                            <form action="{{ route('users.destroy', [app()->getLocale(), $ref->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="select" value="ref">
                                                <button class="delete"><img src=" {{ asset('asset/images/cross.png') }} "
                                                        alt="" class="p-1 align-left float-left   cursor-pointer"></button>
                                            </form>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end reference --}}

    <!--ref-->
    <div class="modal fade" id="addRef" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Add Reference') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6" action="{{ route('users.store', app()->getLocale()) }}"
                            method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="select" value="ref">

                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('Arabic name') }}</label>
                                <input type="text" name="ar_name" class="form-control" id="inputAddress"
                                    placeholder="{{ __('Arabic name') }}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm" class=""> {{ __('Name') }} </label>
                                <input id="password-confirm" type="text" class="form-control" name="name"
                                    placeholder="{{ __('Name') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('Phone') }}</label>
                                <input type="text" name="phone" class="form-control" id="inputAddress"
                                    placeholder="{{ __('Phone') }}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm" class=""> {{ __('Email') }} </label>
                                <input id="password-confirm" type="email" class="form-control" name="email"
                                    autocomplete="new-password" placeholder="{{ __('Email') }}">
                            </div>

                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end ref -->

    <!--ref-->
    <div class="modal fade" id="addAttch" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Attach File') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6" action="{{ route('users.store', app()->getLocale()) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="select" value="attch">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('File Name') }}</label>
                                <input type="text" name="ar_name" class="form-control" id="inputAddress"
                                    placeholder="{{ __('Enter Name') }}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm" class=""> {{ __('Name by English') }} </label>
                                <input id="password-confirm" type="text" class="form-control" name="name"
                                    autocomplete="new-password" placeholder="{{ __('Enter Name') }}">
                            </div>
                            <div class="form-group  col-md-12">
                                <label for="password-confirm" class=""> {{ __('Add file') }} </label>
                                <input id="" type="file" class="form-control" name="attch" autocomplete="new-password"
                                    placeholder="{{ __('') }}">
                            </div>
                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end ref -->

    <!-- language model -->
    <div class="modal fade" id="addlanguage" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ __('Languages') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">

                        <form class="form-horizontal form-row" id="user-form" role="form" method="POST"
                            action="{{ route('users.store', app()->getLocale()) }}" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="select" value="lang">
                            <div class="form-body">
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('Enter Language') }} </label>
                                        <div class="">
                                            <input class="form-control" name="ar_language"
                                                placeholder=" {{ __('Enter Language') }} ">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">{{ __('Enter Language by English') }}</label>
                                        <div class="">
                                            <input class="form-control" name="language"
                                                placeholder="{{ __('Enter Language') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label">{{ __('Choose Level') }}</label>
                                        <select class="form-control" name="language_level">
                                            <option disabled selected>{{ __('Language Level') }} </option>
                                            <option value="Beginner">{{ __('Beginner') }}</option>
                                            <option value="Intermediate">{{ __('Intermediate') }}</option>
                                            <option value="Fluent">{{ __('Fluent') }}</option>
                                            <option value="Mother tounge">{{ __('Mother Tounge') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>


                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end language model -->

    <!-- change image model -->
    <div class="modal fade" id="editimage" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Change Image') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6"
                            action="{{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="select" value="user_edit">
                            <div class="col-md-12 mb-1">
                                <label for="avatar">{{ __('Personal photo') }}</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end change image model -->

    <!-- education model -->
    <div class="modal fade" id="addeducation" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ __('Education Information') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form method="POST" class="form-row col-md-6"
                            action="{{ route('users.store', app()->getLocale()) }}" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="select" value="add_edu">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Certificate') }}</label>
                                <select id="inputState" class="form-control" name="qualification">
                                    <option selected hidden value="">{{ __('Choose the certificate type') }} </option>
                                    <option value="Diploma">{{ __('Diploma') }}</option>
                                    <option value="Bachelor">{{ __('Bachelor') }}</option>
                                    <option value="Master">{{ __('Master') }}</option>
                                    <option value="PH">{{ __('PH') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Special') }}</label>
                                <select name="special_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Special') }}</option>
                                    @foreach ($specials as $special)
                                        <option value="{{ $special->id }}">
                                            {{ app()->getLocale() == 'ar' ? $special->ar_name : $special->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('University') }}</label>
                                <input type="text" class="form-control" name="ar_university" id="inputAddress2"
                                    placeholder="{{ __('Example: Harvard University') }} "
                                    value="{{ $user->ar_university }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('University by English') }}</label>
                                <input type="text" class="form-control" name="university" id="inputAddress2"
                                    placeholder="eg. Harvard " value="{{ $user->university }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label> {{ __('Graduation Date') }} </label>
                                <input type="date" id="datepicker" width="276" class="form-control" name="grade_date"
                                    value="{{ $user->grade_date }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Average') }}</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="" name="grade">
                            </div>
                            <button class="btn btn-primary btn-outline btn-block"
                                type="submit">{{ __('Save') }}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end education model -->

    <!-- change password model -->
    <div class="modal fade" id="changepassword" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Change Password') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6"
                            action="{{ route('users.update', [app()->getLocale(), $user->id]) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('Password') }}</label>
                                <input type="password" name="password" class="form-control" id="inputAddress" required
                                    placeholder="{{ __('Password') }}">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm" class=""> {{ __('Confirm Password') }} </label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="{{ __('Confirm Password') }}">
                            </div>
                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end change password model -->

    <!-- add experience model -->
    <div class="modal fade" id="addexperience" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont" style="height: auto!important;">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Experinces') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form method="POST" class="form-row col-md-6"
                            action="{{ route('users.store', app()->getLocale()) }}" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">{{ __('Comany Name') }}</label>
                                <input type="text" class="form-control" name="company_name" id="inputAddress2"
                                    placeholder="{{ __('Comany Name') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ __('Start year') }}</label>
                                <input type="text" class="form-control" name="start_year" id="inputAddress2"
                                    placeholder="{{ __('Example 2017') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{ __('Start month') }}</label>
                                <input id="datepicker" width="276" class="form-control" name="start_month" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ __('End year') }}</label>
                                <input type="text" class="form-control" id="inputAddress2"
                                    placeholder="{{ __('Example 2019') }}" name="end_year">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">{{ __('End month') }}</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="" name="end_month">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Job Role') }}</label>
                                <select name="role_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Job Role') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->ar_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Job Level') }}</label>
                                <input type="text" class="form-control" id="inputAddress2" name="level"
                                    placeholder="مثلا : اخصائي">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Specialization') }}</label>
                                <select name="special_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Specialization') }}</option>
                                    @foreach ($specials as $special)
                                        <option value="{{ $special->id }}">
                                            {{ app()->getLocale() == 'ar' ? $special->ar_name ?? '' : $special->name ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Country') }}</label>
                                <select name="country_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->ar_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">{{ __('Job Description') }}</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                    placeholder="{{ __('Add Job Description') }}" rows="3"
                                    name="ar_summary"> {{ $user->ar_summary }} </textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">{{ __('Description by English') }}</label>
                                <textarea class="form-control" id="exampleFormControlTextarea2"
                                    placeholder="{{ __('Add Job Description') }}" rows="3"
                                    name="summary">{{ $user->summary }}</textarea>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label
                                    for="exampleFormControlTextarea1">{{ __('Add experience certificate (optional)') }}</label>
                                <input type="file" required name="cert_pdf">
                            </div>
                            <button class="btn btn-primary btn-outline" type="submit">{{ __('Save') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end add experience model -->

    <!-- personal info model -->
    <div class="modal fade" id="personalinfo" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ __('Edit personal data') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6" method="POST"
                            action="{{ route('users.update', [app()->getLocale(), $user->id]) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="select" value="user_edit">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Name') }} </label>
                                <input type="text" class="form-control" value="{{ $user->ar_name }}" name="ar_name"
                                    placeholder="{{ __('Enter Name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Name by English') }} </label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Last Name') }} </label>
                                <input type="text" class="form-control" value="{{ $user->ar_last_name }}"
                                    name="ar_last_name" placeholder="{{ __('Enter Last name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Last Name by English') }} </label>
                                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"
                                    placeholder="...">
                            </div>
                            <div class="form-group col-md-6 pr-2">
                                <label for="inputState"
                                    style="vertical-align:bottom; display: table; margin-bottom: 0.5rem;">{{ __('Gender') }}</label>
                                <div class="form-check form-check-inline">
                                    <input {{ $user->gender == 'Male' ? 'checked' : '' }} class="form-check-input"
                                        type="radio" name="gender" id="inlineRadio1" value="Male">
                                    <label class="form-check-label" for="inlineRadio1">{{ __('Male') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input {{ $user->gender == 'Female' ? 'checked' : '' }} class="form-check-input"
                                        type="radio" name="gender" id="inlineRadio2" value="Female">
                                    <label class="form-check-label" for="inlineRadio2">{{ __('Female') }}</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> {{ __('Nationality') }}</label>
                                <select name="birth_country_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Nationality') }}</option>
                                    @foreach ($countries as $country)
                                        <option {{ $user->ar_birth == $country->ar_name ? 'selected' : '' }}
                                            value="{{ $country->id }}">
                                            {{ app()->getLocale() == 'ar' ? $country->ar_name : $country->ar_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{ __('Birth Date') }}</label>
                                <input type="date" id="datepicker" width="276" class="form-control" name="brithDate"
                                    value="{{ $user->birthdate }}" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Current Housing') }}</label>
                                <select name="country_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Current Housing') }}</option>
                                    @foreach ($countries as $country)
                                        <option {{ $user->country_id == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">
                                            {{ app()->getLocale() == 'ar' ? $country->ar_name : $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Role') }}</label>
                                <select name="role_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Role') }}</option>
                                    @foreach ($roles as $role)
                                        <option {{ $user->role_id == $role->id ? 'selected' : '' }}
                                            value="{{ $role->id }}">
                                            {{ app()->getLocale() == 'ar' ? $role->ar_name : $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Job title') }}</label>
                                <select name="special_id" id="inputState" class="form-control">
                                    <option selected disabled>{{ __('Job title') }}</option>
                                    @foreach ($specials as $special)
                                        <option {{ $user->special_id == $special->id ? 'selected' : '' }}
                                            value="{{ $special->id }}">
                                            {{ app()->getLocale() == 'ar' ? $special->ar_name : $special->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{ __('Job Level') }}</label>
                                <input type="text" width="276" class="form-control" name="level"
                                    value="{{ $user->level }}" placeholder="مثلا : اخصائي" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputState">{{ __('Religion') }}</label>
                                <select id="inputState" class="form-control" name="religion">
                                    <option selected hidden value="{{ $user->religion }}">
                                        {{ app()->getLocale() == 'ar' ? $user->ar_religion : $user->religion }}</option>
                                    <option value="Muslime">{{ __('Muslime') }}</option>
                                    <option value="Christian">{{ __('Christian') }}</option>
                                    <option value="Gushin">{{ __('Gushin') }}</option>
                                    <option value="Other">{{ __('Other') }}</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState"> {{ __('Social Status') }} </label>
                                <select id="inputState" class="form-control" name="social_status">
                                    <option selected hidden value="{{ $user->social_status }}">
                                        {{ app()->getLocale() == 'ar' ? $user->ar_social_status : $user->social_status }}
                                    </option>
                                    <option value="Married">{{ __('Married') }}</option>
                                    <option value="Single">{{ __('Single') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputState">{{ __('Passport No.') }}</label>
                                <input type="text" class="form-control" placeholder="" name="idint_1"
                                    value="{{ $user->idint_1 }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">{{ __('National No.') }}</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="" name="idint_2"
                                    value="{{ $user->idint_2 }}">
                            </div>

                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- end personl Modal -->

    <!-- contact model -->
    <div class="modal fade" id="contact" style="padding-right: 0;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content fill-cont">
                <div class="modal-header">
                    <h5 class="modal-title"> {{ __('Edit Contact Details') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <div class="row justify-content-center">
                        <form class="form-row col-md-6"
                            action="{{ route('users.update', [app()->getLocale(), $user->id]) }}" method="post"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $user->id }}" id="">
                            <input type="hidden" name="select" value="user_edit" id="">

                            <div class="form-group col-md-6">
                                <label for="inputAddress"> {{ __('Phone Number') }} </label>
                                <input name="phone" type="text" class="form-control" id="inputAddress"
                                    value="{{ $user->phone }}" placeholder="  {{ __('Enter Phone number') }} ">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">{{ __('Email') }}</label>
                                <input name="email" type="text" class="form-control" id="inputAddress"
                                    value="{{ $user->email }}" placeholder=" {{ __('Enter Email') }}  ">
                            </div>
                            <div class="form-groub col-md-12">
                                <div class="text-center py-5">
                                    <button class="btn btn-primary px-3 " type="submit"> {{ __('Save') }} </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact model -->

@endsection

@section('scripts')
    {{-- <script src="{{asset('js/app.js')}}"></script> --}}

    <script src=" {{ asset('asset/js/jquery.printPage.js') }} "></script>

    <script>
        $(document).ready(function() {
            $('#download-attachment').printPage();
        });
        //  const app = new Vue({
        //       el: '#app',


        //       data: {

        //           tag:false,
        //           id: '',
        //           re: []

        //       },
        //       mounted(){

        //           },
        //       methods: {
        //           put(value) {
        //             axios.get('/search/' + value)
        //               .then((res)=>{
        //                 console.log(res.data);
        //             })
        //           },
        //       }

        //       });

    </script>
@endsection
