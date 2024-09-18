/*
 * Leaflet.draw assumes that you have already included the Leaflet library.
 */

L.drawVersion = '0.3.0-dev';

L.drawLocal = {
	draw: {
		toolbar: {
			// #TODO: this should be reorganized where actions are nested in actions
			// ex: actions.undo  or actions.cancel
			actions: {
				title: 'Zamknij rysowanie',
				text: 'Zamknij'
			},
			finish: {
				title: 'Zakończ rysowanie',
				text: 'Zakończ'
			},
			undo: {
				title: 'Usuń ostatni narysowany punkt',
				text: 'Usuń ostatni punkt'
			},
			buttons: {
				polyline: 'Narysuj łamaną',
				polygon: 'Narysuj wielokąt',
				rectangle: 'Narysuj prostokąt',
				circle: 'Narysuj okrąg',
				marker: 'Narysuj znacznik'
			}
		},
		handlers: {
			circle: {
				tooltip: {
					start: 'Kliknij i przeciągnij, aby narysować okrąg.'
				},
				radius: 'Promień'
			},
			marker: {
				tooltip: {
					start: 'Kliknij na mapie, aby umieścić znacznik.'
				}
			},
			polygon: {
				tooltip: {
					start: 'Kliknij, aby rozpocząć rysowanie kształtu.',
					cont: 'Kliknij, aby kontynuować rysowanie kształtu.',
					end: 'Podwójne kliknięcie kończy rysowanie kształtu.'
				}
			},
			polyline: {
				error: '<strong>Błąd:</strong> krawędzie nie moga się przecinać!',
				tooltip: {
					start: 'Kliknij, aby rozpocząć rysowanie linii.',
					cont: 'Kliknij, aby kontynuować rysowanie linii.',
					end: 'Kliknij ostatni punkt, aby zakończyć linię.'
				}
			},
			rectangle: {
				tooltip: {
					start: 'Kliknij i przeciągnij, aby narysować prostokąt.'
				}
			},
			simpleshape: {
				tooltip: {
					end: 'Zwolnij przycisk myszy, aby zakończyć rysowanie.'
				}
			}
		}
	},
	edit: {
		toolbar: {
			actions: {
				save: {
					title: 'Zapisz zmiany.',
					text: 'Zapisz'
				},
				cancel: {
					title: 'Anuluj edycję, odrzucić wszystkie zmiany.',
					text: 'Anuluj'
				}
			},
			buttons: {
				edit: 'Edytuj warstwę.',
				editDisabled: 'Brak warstw do edycji.',
				remove: 'Usuń warstwę.',
				removeDisabled: 'Brak warstw do usunięcia.'
			}
		},
		handlers: {
			edit: {
				tooltip: {
					text: 'Chwyć wierzchołek lub znacznik aby edywować warstwę.',
					subtext: 'Kliknij Anuluj, aby cofnąć zmiany.'
				}
			},
			remove: {
				tooltip: {
					text: 'Kliknij na warstwę aby usunąć'
				}
			}
		}
	}
};
