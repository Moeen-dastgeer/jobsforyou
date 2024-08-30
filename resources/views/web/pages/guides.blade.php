<x-app-layout>
    <main>
        <x-front.filter />
        <section class="p-0 bg-light" style="min-height: 80vh;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card rounded-0 border-0 mb-2">
                            <div class="card-body">
                                <div class="title pt-2">
                                    <h3>Guides</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 border-0 mb-3">
                            <div class="card-body">
                                <h5>NOS VIDEOS CONSEILS</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <iframe style="width: 100%;height: 200px;"
                                            src="https://www.youtube.com/embed/yAoLSRbwxL8" frameborder="0"
                                            allowfullscreen></iframe>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum enim sequi
                                            adipisci voluptate facere quas.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <iframe style="width: 100%;height: 200px;"
                                            src="https://www.youtube.com/embed/yAoLSRbwxL8" frameborder="0"
                                            allowfullscreen></iframe>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium animi
                                            quaerat quo sequi, ea laudantium.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 border-0 mb-3">
                            <div class="card-body">
                                <h5>RESSOURCES HUMAINES</h5>
                                <strong>Nul n’est censé ignorer la loi !</strong>
                                <p>Intégrer le monde professionnel exige de votre part une bonne connaissance de vos
                                    droits et de vos devoirs</p>
                                <p>A travers ce guide, nous mettons à votre disposition, des réponses claires et
                                    précises basées sur le code du travail
                                    marocain.</p>
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Contrats et clauses</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Absences et Congés</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Sanction et départ</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Procédures CNSS ET AMO</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0 border-0 mb-3">
                            <div class="card-body">
                                <h5>PRODUCTION</h5>
                                <p>Principalement destiné aux débutants, ce guide vous permettra de découvrir le secteur
                                    des centres d’appels au Maroc.
                                </p>
                                <p>Nous vous proposons ainsi un aperçu des principales fonctions et un listing des
                                    activités en réception ou en émission
                                    sur lesquelles vous serez amenés à travailler. Vous trouverez également un glossaire
                                    regroupant les termes spécifiques à
                                    ce secteur.</p>
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Contrats et clauses</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Absences et Congés</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="https://via.placeholder.com/120x120" class="rounded-circle mb-2"
                                            alt=""><br />
                                        <a href="#" class="link-dark">Sanction et départ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-front.recruiting />
                        <x-front.quiz />
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-slot name="footer">
        
    </x-slot>
</x-app-layout>
